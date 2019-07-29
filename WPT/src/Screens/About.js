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
import { DrawerActions } from "react-navigation";
import Icon from "react-native-vector-icons/FontAwesome";
import commonStyles from "../CommonStyles";
import bg from "../../assets/images/bg.jpg";
import "whatwg-fetch";
import {
  server,
  showError,
  getPerformanceColor,
  getCdnLevel,
  getScore
} from "../../common";

export default class About extends Component {
  componentDidMount() {
    this.backHandler = BackHandler.addEventListener("hardwareBackPress", () => {
      this.props.navigation.navigate("App");
      return true;
    });
  }

  componentWillUnmount() {
    this.backHandler.remove();
  }

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
            <Text style={styles.title}>About</Text>
          </View>
          <View>
            <Text style={styles.subtitle}> Website Performance Tester</Text>
          </View>
        </ImageBackground>
        <View style={styles.sitesContainer}>
          <Text style={styles.info}>Website Performance Tester</Text>
          <Text style={styles.info}>Version: 1.0</Text>
          <Text style={styles.info}>Developed by: Mateus Getulio Vieira</Text>
          <Text style={styles.info}>Powered by: Webpage Test API</Text>
        </View>
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
