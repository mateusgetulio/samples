import React, { Component } from "react";
import {
  View,
  ScrollView,
  Platform,
  Text,
  Modal,
  TextInput,
  TouchableWithoutFeedback,
  TouchableOpacity,
  ImageBackground,
  StyleSheet,
  RefreshControl,
  BackHandler
} from "react-native";
import NetInfo from "NetInfo";
import AsyncStorage from "AsyncStorage";
import { DrawerActions } from "react-navigation";
import Icon from "react-native-vector-icons/FontAwesome";
import commonStyles from "../commonStyles";
import bg from "../../assets/images/bg.jpg";
import "whatwg-fetch";
import {
  server,
  showError,
  getPerformanceColor,
  getCdnLevel,
  getScore
} from "../../common";

export default class ViewSite extends Component {
  // Initialize the state with the data coming from the last screen
  initialState = {
    site: this.props.navigation.getParam("site"),
    loadTime: this.props.navigation.getParam("loadTime") || "0",
    firstByte: this.props.navigation.getParam("firstByte") || "0",
    startRender: this.props.navigation.getParam("startRender") || "0",
    requests: this.props.navigation.getParam("requests") || "0",
    bytesIn: this.props.navigation.getParam("bytesIn") || "0",
    cdnSystem: this.props.navigation.getParam("cdnSystem") || "Pending",
    score: this.props.navigation.getParam("score") || "0",
    refreshing: false,
    connected: false
  };

  state = { ...this.initialState };

  componentDidMount() {
    // If the website has never been fetched then it triggers 
    // the perfomance measure event, otherwise it only displays
    // the data that's already there
    this.state.score == 0 && this.loadSite();
    // Handle the back key press
    this.backHandler = BackHandler.addEventListener("hardwareBackPress", () => {
      this.props.navigation.navigate("App");
      return true;
    });
  }

  // Save the data fetched to the local storage
  saveToStorage = async () => {
    try {
      // Find the place data needs to be saved
      const value = await AsyncStorage.getItem("sites");
      if (value !== null) {
        let sites = JSON.parse(value) || [];
        // Data treatment, if there's data in the storage already, 
        // it only updates it, otherwise data will be put for
        // the first time
        sites.forEach(element => {
          if (this.props.navigation.getParam("site") == element.site.toLowerCase()) {
            element.site = this.props.navigation.getParam("site");
            element.loadTime = this.state.loadTime;
            element.firstByte = this.state.firstByte;
            element.startRender = this.state.startRender;
            element.requests = this.state.requests;
            element.bytesIn = this.state.bytesIn;
            element.cdnSystem = this.state.cdnSystem;
            element.score = this.state.score;
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

        // Push the data to the storage
        await AsyncStorage.setItem("sites", JSON.stringify(sites));
      }
    } catch (e) {
      showError(e.toString());
    }
  };

  componentWillUnmount() {
    this.backHandler.remove();
  }

  // Load website method
  loadSite = async () => {
    // Check if the phone has a working internet connection
    await NetInfo.getConnectionInfo().then(connectionInfo => {
      this.setState({
        connected: connectionInfo.type != "none" ? true : false
      });
    });

    if (this.state.connected == false) {
      showError("Your phone doesn't seem to be connected to the internet");
    } else {
      // Trigger the device refreshing page
      this.setState({ refreshing: true });
      let statusCode = 100;

      // Call the API to get the perfomance test started
      const response = await fetch(
        `${server}/runtest.php?url=${this.state.site.replace(
          /^(\/\/|^.*?:(\/\/)?(www.)?)|(www.)/,
          ""
        )}&k=A.1b0c60ef9d8c0fb76b3f4573bae91c32&f=json&fvonly=1`
      );
      const json = await response.json();

      // Get the URL in which the API will dump the perfomance data
      let url = json.data.jsonUrl;


      // Await the API call end
      while (statusCode < 199) {
        // Once the API call ends, fetch the data
        const newResponse = await fetch(url);
        const newJson = await newResponse.json();
        // Obtain the status from the API call
        statusCode = newJson.statusCode;


        // Test for success
        if (statusCode == 200) {
          // Prepare the state update
          newState = {
            site: this.state.site,
            loadTime: newJson.data.median.firstView.fullyLoaded,
            firstByte: newJson.data.median.firstView.requests[1].download_start,
            startRender: newJson.data.median.firstView.firstImagePaint,
            requests: newJson.data.median.firstView.requestsFull,
            bytesIn: newJson.data.median.firstView.bytesIn,
            // Calculate the CDN score
            cdnSystem: getCdnLevel(newJson.data.median.firstView.score_cdn),
            // Calculate the overall score
            score: getScore(
              newJson.data.median.firstView.fullyLoaded,
              newJson.data.median.firstView.requests[1].download_start,
              newJson.data.median.firstView.bytesIn,
              newJson.data.median.firstView.score_cdn
            ),
            // Set the refresh page as false
            refreshing: false,
            connected: false
          };
          
          if (this.state.refreshing) {
            // Update the state
            this.setState({ ...newState, refreshing: false, connected: false });
            // Save the new data to the local storage
            this.saveToStorage();
          }
        }
      }
    }
  };

  render() {
    return (
      <View style={styles.container}>
        <ImageBackground source={bg} style={styles.background}>
          <View style={[styles.titleBar, styles.iconBar]}>
            <View style={styles.icon}>
              <TouchableOpacity
                onPress={() =>
                  this.props.navigation.navigate("App", { ...this.state })
                }
              >
                <Icon
                  name="arrow-left"
                  size={23}
                  color={commonStyles.colors.secondary}
                />
              </TouchableOpacity>
            </View>
            <Text style={styles.title}>Details</Text>
          </View>
          <View>
            <Text
              numberOfLines={1}
              ellipsizeMode={"tail"}
              style={styles.subtitle}
            >
              {this.state.site}
            </Text>
          </View>
        </ImageBackground>
        <View style={styles.sitesContainer}>
          <ScrollView
            refreshControl={
              <RefreshControl
                refreshing={this.state.refreshing}
                onRefresh={this.loadSite}
              />
            }
          >
            <Text style={styles.info}>
              <Icon name="clock-o" style={{ fontWeight: "300" }} size={20} />{" "}
              {`Total load time: ${this.state.loadTime} ms`}
            </Text>

            <Text style={styles.info}>
              <Icon name="clock-o" style={{ fontWeight: "300" }} size={20} />{" "}
              {`First byte received: ${this.state.firstByte} ms`}
            </Text>
            <Text style={styles.info}>
              <Icon name="clock-o" style={{ fontWeight: "300" }} size={20} />{" "}
              {`Started rendering: ${this.state.startRender} ms`}
            </Text>
            <Text style={styles.info}>
              <Icon name="hashtag" style={{ fontWeight: "300" }} size={20} />{" "}
              {`Requests: ${this.state.requests}`}
            </Text>
            <Text style={styles.info}>
              <Icon name="database" style={{ fontWeight: "300" }} size={20} />{" "}
              {`Bytes in: ${this.state.bytesIn} bytes`}
            </Text>
            <Text style={styles.info}>
              <Icon name="cloud" style={{ fontWeight: "300" }} size={20} /> CDN
              System: {this.state.cdnSystem}
            </Text>
            <Text
              style={[
                styles.info,
                {
                  color: getPerformanceColor(this.state.score),
                  fontWeight: "400"
                }
              ]}
            >
              {" "}
              <Icon name="bolt" style={{ fontWeight: "300" }} size={25} />
              {` Overall score: ${this.state.score}%`}
            </Text>
          </ScrollView>
        </View>
      </View>
    );
  }
}

// View style
const styles = StyleSheet.create({
  container: {
    flex: 1
  },
  background: {
    flex: 2
  },
  titleBar: {
    flexDirection: "column"
  },
  iconBar: {
    marginTop: Platform.OS === "ios" ? 40 : 18,
    marginHorizontal: 20,
    flexDirection: "row"
  },
  icon: {
    paddingTop: 6
  },
  title: {
    textShadowColor: "#000",
    textShadowOffset: { width: 2, height: 3 },
    textShadowRadius: 2,
    fontFamily: commonStyles.fontFamilu,
    color: commonStyles.colors.secondary,
    fontSize: 26,
    marginLeft: 10,
    alignContent: "center"
  },
  subtitle: {
    textShadowColor: "#000",
    textShadowOffset: { width: 2, height: 3 },
    textShadowRadius: 2,
    fontFamily: commonStyles.fontFamily,
    color: commonStyles.colors.secondary,
    fontSize: 25,
    marginLeft: 20,
    alignContent: "center"
  },
  info: {
    fontFamily: commonStyles.fontFamily,
    color: commonStyles.colors.mainText,
    fontSize: 22,
    marginLeft: 10,
    paddingTop: 7,
    paddingBottom: 8
  },
  sitesContainer: {
    flex: 8
  }
});
