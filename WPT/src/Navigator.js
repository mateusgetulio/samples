import React from "react";
import { createSwitchNavigator, createDrawerNavigator } from "react-navigation";

import Menu from "./Screens/Menu";
import App from "./Screens/App";
import ViewSite from "./Screens/ViewSite";
import About from "./Screens/About";

import commonStyles from "./CommonStyles";

const MenuRoutes = {
  List: {
    name: "List",
    screen: props => <App {...props} />,
    navigationOptions: {
      title: "Home"
    }
  },
  Erase: {
    name: "Erase",
    screen: props => <App {...props} eraseData={true} />,
    navigationOptions: {
      title: "Clear data"
    }
  },
  About: {
    name: "About",
    screen: props => <About {...props} eraseData={true} />,
    navigationOptions: {
      title: "About"
    }
  }
};

const MenuConfig = {
  initialRouteName: "List",
  contentComponent: Menu,
  contentOptions: {
    labelStyle: {
      fontFamily: commonStyles.fontFamily,
      fontWeight: "normal",
      fontSize: 20
    },
    activeLabelStyle: {
      color: "#080"
    }
  }
};

const MenuNavigator = createDrawerNavigator(MenuRoutes, MenuConfig);

const MainRoutes = {
  App: {
    name: "App",
    screen: App
  },
  ViewSite: {
    name: "ViewSite",
    screen: ViewSite
  },
  Home: {
    name: "Home",
    screen: MenuNavigator
  }
};

const MainNavigator = createSwitchNavigator(MainRoutes, {
  initialRouteName: "App"
});

export default MainNavigator;
