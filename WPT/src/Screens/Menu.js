import React, { Component } from "react";
import {
  ScrollView,
  View,
  Text,
  StyleSheet,
  AsyncStorage,
  TouchableOpacity
} from "react-native";

import { DrawerItems } from "react-navigation";

import Icon from "react-native-vector-icons/FontAwesome";
import commonStyles from "../CommonStyles";

export default class Menu extends Component {
  render() {
    return (
      <ScrollView>
        <View style={styles.header}>
          <Text style={styles.title}>WPT</Text>
        </View>
        <DrawerItems {...this.props} />
      </ScrollView>
    );
  }
}

const styles = StyleSheet.create({
  header: {
    borderBottomWidth: 1,
    borderColor: "#DDD"
  },
  title: {
    backgroundColor: "#FFF",
    color: "#000",
    fontFamily: commonStyles.fontFamily,
    fontSize: 30,
    paddingTop: 30,
    padding: 10
  },
  avatar: {
    width: 60,
    height: 60,
    borderWidth: 3,
    borderColor: "#AAA",
    borderRadius: 30,
    margin: 10
  },
  name: {
    fontFamily: commonStyles.fontFamily,
    color: commonStyles.colors.mainText,
    fontSize: 20,
    marginLeft: 10
  },
  email: {
    fontFamily: commonStyles.fontFamily,
    color: commonStyles.colors.subText,
    fontSize: 15,
    marginLeft: 10,
    marginBottom: 10
  },
  menu: {
    justifyContent: "center",
    alignItems: "stretch"
  },
  userInfo: {
    flexDirection: "row",
    justifyContent: "space-between"
  },
  logoutIcon: {
    justifyContent: "center",
    alignItems: "center",
    marginRight: 20
  }
});
