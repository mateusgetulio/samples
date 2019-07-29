import React, { Component } from "react";
import {
  TouchableOpacity,
  Platform,
  StyleSheet,
  ImageBackground,
  Text,
  Modal,
  FlatList,
  RefreshControl,
  View
} from "react-native";
import Icon from "react-native-vector-icons/FontAwesome";
import ActionButton from "react-native-action-button";
import AsyncStorage from "AsyncStorage";
import { DrawerActions } from "react-navigation";
import NetInfo from "NetInfo";
import {
  server,
  showError,
  showWarning,
  sitesLimit,
  confirmAction,
  getCdnLevel,
  delay,
  getScore
} from "../../common";
import AddSite from "./AddSite";
import ViewSite from "./ViewSite";
import Progress from "./Progress";
import "whatwg-fetch";
import Site from "../Components/Site";
import commonStyles from "../CommonStyles";
import bg from "../../assets/images/bg.jpg";

export default class App extends Component {
  newSites = [];
  state = {
    sites: [],
    showAddSite: false,
    showProgress: false,
    currentSite: 1,
    refreshing: false,
    connected: false
  };

  componentDidMount = async () => {
    this.props.eraseData &&
      confirmAction(
        "WARNING",
        "Are you sure you want to delete all your data?",
        this.deleteData
      );

    try {
      const value = await AsyncStorage.getItem("sites");
      if (value !== null) {
        this.setState({ refreshing: true });
        let sites = JSON.parse(value) || [];
        sites.forEach(element => {
          if (
            this.props.navigation.getParam("site") == element.site.toLowerCase()
          ) {
            element.site = this.props.navigation.getParam("site");
            element.loadTime = this.props.navigation.getParam("loadTime");
            element.firstByte = this.props.navigation.getParam("firstByte");
            element.startRender = this.props.navigation.getParam("startRender");
            element.requests = this.props.navigation.getParam("requests");
            element.bytesIn = this.props.navigation.getParam("bytesIn");
            element.cdnSystem = this.props.navigation.getParam("cdnSystem");
            element.score = this.props.navigation.getParam("score");
          } else {
            element.site = element.site.toLowerCase();
            element.loadTime = element.loadTime || 0;
            element.firstByte = element.firstByte || 0;
            element.startRender = element.startRender || 0;
            element.requests = element.requests || 0;
            element.bytesIn = element.bytesIn || 0;
            element.cdnSystem = element.cdnSystem || "Pending";
            element.score = element.score || 0;
          }
        });
        this.setState({ sites, refreshing: false, connected: false });
        this.props.navigation.dispatch(DrawerActions.closeDrawer());
        if (this.props.navigation.getParam("site"))
          await AsyncStorage.setItem("sites", JSON.stringify(sites));
      }
    } catch (e) {
      showError(e.toString());
      this.setState({ refreshing: true });
    }
  };

  addSite = async newSite => {
    const dupeSites = this.state.sites
      .map(element =>
        element.site.replace(/^(\/\/|^.*?:(\/\/)?(www.)?)|(www.)/, "")
      )
      .filter(
        element =>
          element.toLowerCase() ==
          newSite.site
            .replace(/^(\/\/|^.*?:(\/\/)?(www.)?)|(www.)/, "")
            .toLowerCase()
      );

    if (dupeSites.length > 0) {
      this.setState({
        showAddSite: false,
        showProgress: false,
        currentSite: 1,
        refreshing: false,
        connected: false
      });
      return false;
    }

    const sites = [...this.state.sites];
    sites.push({
      id: Math.random(),
      site: newSite.site.toLowerCase(),
      score: 0,
      loadTime: 0,
      firstByte: 0,
      startRender: 0,
      requests: 0,
      bytesIn: 0,
      cdnSystem: "Pending",
      score: 0
    });

    try {
      await AsyncStorage.setItem("sites", JSON.stringify(sites));
    } catch (e) {
      showError(e.toString());
    }

    this.setState({
      sites,
      showAddSite: false,
      showProgress: false,
      currentSite: 1,
      refreshing: false,
      connected: false
    });
  };

  deleteSite = async id => {
    const sites = this.state.sites.filter(element => element.id !== id);
    this.setState({
      sites,
      showAddSite: false,
      showProgress: false,
      currentSite: 1,
      refreshing: false,
      connected: false
    });

    try {
      await AsyncStorage.setItem("sites", JSON.stringify(sites));
    } catch (e) {
      showError(e.toString());
    }
  };

  navigateHome = () => {
    this.setState({ refreshing: false, showProgress: false });
  };

  cancelRefresh = () => {
    confirmAction(
      "WARNING",
      "Are you sure you want to abort the tests?",
      this.navigateHome
    );
  };

  refreshSites = async () => {
    await NetInfo.getConnectionInfo().then(connectionInfo => {
      this.setState({
        connected: connectionInfo.type != "none" ? true : false
      });
    });

    if (this.state.connected == false) {
      showError("Your phone doesn't seem to be connected to the internet");
    } else {
      this.setState({ refreshing: true, showProgress: true });
      this.newSites = this.state.sites;
      const sites = this.state.sites;
      try {
        let current = 0;
        for (let site of sites) {
          current++;
          this.setState({ currentSite: current });

          await this.fetchSite(site.id, site.site);
        }

        if (this.state.showProgress) {
          await this.setState({
            sites: this.newSites,
            showAddSite: false,
            showProgress: false,
            currentSite: 1,
            refreshing: false,
            connected: false
          });

          await AsyncStorage.setItem("sites", JSON.stringify(this.state.sites));
        }

        newSites = [];
      } catch (error) {
        this.setState({ refreshing: false, connected: false });
        showError(error);
      }
    }
  };

  fetchSite = async (siteId, site) => {
    let statusCode = 100;

    const response = await fetch(
      `${server}/runtest.php?url=${site.replace(
        /^(\/\/|^.*?:(\/\/)?(www.)?)|(www.)/,
        ""
      )}&k=A.1b0c60ef9d8c0fb76b3f4573bae91c32&f=json&fvonly=1`
    );
    const json = await response.json();

    let url = json.data.jsonUrl;

    while (statusCode < 199) {
      const newResponse = await fetch(url);
      const newJson = await newResponse.json();
      statusCode = newJson.statusCode;

      if (statusCode == 200) {
        this.newSites = this.newSites.filter(element => element.id !== siteId);

        this.newSites.push({
          id: siteId,
          site: site,
          loadTime: newJson.data.median.firstView.fullyLoaded,
          firstByte: newJson.data.median.firstView.requests[1].download_start,
          startRender: newJson.data.median.firstView.firstImagePaint,
          requests: newJson.data.median.firstView.requestsFull,
          bytesIn: newJson.data.median.firstView.bytesIn,
          cdnSystem: getCdnLevel(newJson.data.median.firstView.score_cdn),
          score: getScore(
            newJson.data.median.firstView.fullyLoaded,
            newJson.data.median.firstView.requests[1].download_start,
            newJson.data.median.firstView.bytesIn,
            newJson.data.median.firstView.score_cdn
          )
        });
      }
    }
  };

  deleteData = async () => {
    await AsyncStorage.clear();
    this.props.navigation.navigate("App");
  };

  openMenu = () => {
    this.props.navigation.dispatch(DrawerActions.toggleDrawer());
  };

  render() {
    return (
      <View style={styles.container}>
        <AddSite
          isVisible={this.state.showAddSite}
          onSave={this.addSite}
          onCancel={() =>
            this.setState({
              showAddSite: false,
              showProgress: false,
              currentSite: 1,
              refreshing: false,
              connected: false
            })
          }
        />
        <Progress
          isVisible={this.state.showProgress}
          current={this.state.currentSite}
          total={this.state.sites.length}
          onCancel={() => this.cancelRefresh()}
        />
        <ImageBackground source={bg} style={styles.background}>
          <View style={styles.iconBar}>
            <View style={{ paddingTop: 22 }}>
              <TouchableOpacity onPress={() => this.openMenu()}>
                <Icon
                  name="bars"
                  size={29}
                  color={commonStyles.colors.secondary}
                />
              </TouchableOpacity>
            </View>
            <Text style={styles.title}>WPT</Text>
          </View>
        </ImageBackground>
        <View style={styles.sitesContainer}>
          <FlatList
            refreshControl={
              <RefreshControl
                refreshing={this.state.refreshing}
                onRefresh={this.refreshSites}
              />
            }
            data={this.state.sites}
            keyExtractor={item => `${item.id}`}
            renderItem={({ item }) => (
              <Site {...item} {...this.props} onDelete={this.deleteSite} />
            )}
          />
        </View>
        <ActionButton
          buttonColor={
            this.state.sites.length >= sitesLimit
              ? commonStyles.colors.disabled
              : commonStyles.colors.action
          }
          onPress={() => {
            this.state.sites.length >= sitesLimit
              ? showWarning("Sites limit exceeded")
              : this.setState({ showAddSite: true });
          }}
        />
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1
  },
  background: {
    flex: 2
  },
  title: {
    textShadowColor: "#000",
    textShadowOffset: { width: 2, height: 3 },
    textShadowRadius: 2,
    fontFamily: commonStyles.fontLogo,
    color: commonStyles.colors.secondary,
    fontSize: 40,
    fontWeight: "600",
    marginLeft: 20,
    marginTop: 8
  },
  sitesContainer: {
    flex: 8
  },
  iconBar: {
    marginTop: Platform.OS === "ios" ? 30 : 10,
    marginHorizontal: 20,
    flexDirection: "row"
  },
  disabled: {
    backgroundColor: "#000",
    color: "#666666"
  }
});
