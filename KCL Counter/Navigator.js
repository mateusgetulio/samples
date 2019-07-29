import React from "react";
import { createSwitchNavigator, createDrawerNavigator } from "react-navigation";

import AuthOrApp from "./screens/AuthOrApp";
import Menu from "./screens/Menu";
import Auth from "./screens/Auth";
import App from "./screens/App";

import commonStyles from "../commonStyles";

const MenuRoutes = {
  Home: {
    name: "Home",
    screen: props => <App {...props} />,
    navigationOptions: {
      title: "Home",
      tabBarVisible: false
    }
  }
};

const MenuConfig = {
  initialRouteName: "Home",
  contentComponent: Menu,
  contentOptions: {
    labelStyle: {
      fontFamily: commonStyles.fontFamily,
      fontWeight: "normal",
      display: "none",
      fontSize: 20
    },
    activeLabelStyle: {
      color: "#080"
    }
  }
};

const MenuNavigator = createDrawerNavigator(MenuRoutes, MenuConfig);

const MainRoutes = {
  Loading: {
    name: "Loading",
    screen: AuthOrApp
  },
  Auth: {
    name: "Auth",
    screen: Auth
  },
  Home: {
    name: "Home",
    screen: MenuNavigator
  }
};

const MainNavigator = createSwitchNavigator(MainRoutes, {
  initialRouteName: "Loading"
});
export default MainNavigator;
