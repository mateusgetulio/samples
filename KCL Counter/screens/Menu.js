import React, { Component } from "react";
import {
  ScrollView,
  View,
  Text,
  StyleSheet,
  TouchableOpacity
} from "react-native";
import AsyncStorage from "AsyncStorage";
import { Gravatar } from "react-native-gravatar";
import { DrawerItems } from "react-navigation";
import axios from "axios";
import Icon from "react-native-vector-icons/FontAwesome";
import commonStyles from "../../commonStyles";
import { server } from "../../common";

// Initialize the data that is displayed in the menu
userEmail = "";
userName = "";

export default class Menu extends Component {
  // Logout method
  logout = async () => {
    // Token deletion
    delete axios.defaults.headers.common["Authorization"];
    // Clear the store
    AsyncStorage.removeItem("userData");
    await AsyncStorage.clear();
    // Navigate to the login page
    this.props.navigation.navigate("Loading");
  };

  componentDidMount = async () => {
    // Get the logged user data
    await axios.get(`${server}/user/current`).then(res => {
      userEmail = res.data.email;
      userName = res.data.name;
    });
  };

  render() {
    return (
      <ScrollView>
        <View style={styles.header}>
          <Text style={styles.title}>Profile</Text>
          <Gravatar
            style={styles.avatar}
            options={{
              email: userEmail,
              secure: true
            }}
          />
          <View style={styles.userInfo}>
            <View>
              <Text style={styles.name}>{userName}</Text>
              <Text style={styles.email}>{userEmail}</Text>
            </View>
            <TouchableOpacity onPress={this.logout}>
              <View style={styles.logoutIcon}>
                <Icon name="sign-out" size={30} color="#800" />
              </View>
            </TouchableOpacity>
          </View>
        </View>
        <DrawerItems {...this.props} />
      </ScrollView>
    );
  }
}


// View style
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
