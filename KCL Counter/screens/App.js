import React, { Component } from "react";
import {
  Platform,
  StyleSheet,
  Text,
  TextInput,
  TouchableWithoutFeedback,
  TouchableOpacity,
  ImageBackground,
  Alert,
  View,
  FlatList,
  Linking
} from "react-native";
import Orientation from "react-native-orientation-locker";
import { DrawerActions } from "react-navigation";
import axios from "axios";
import AsyncStorage from "AsyncStorage";
import Icon from "react-native-vector-icons/FontAwesome";
import BottomNavigation, {
  FullTab
} from "react-native-material-bottom-navigation";


import SearchFood from "./SearchFood";
import CategoriesSelection from "./CategoriesSelection";
import foodList from "../../foodList";
import Food from "../components/Food";
import commonStyles from "../../commonStyles";
import bg from "../../assets/images/bg.jpg";
import { showError, showWarning, server, kclReportUrl } from "../../common";

userEmail = "";
userName = "";

export default class App extends Component {
  state = {
    totalCalories: 0,
    foods: [],
    history: [],
    searchIsVisible: false,
    categoryIsVisible: false,
    historyIsVisible: false
  };

  today() {
    var date = new Date();

    return (
      date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()
    );
  }

  transmitDate = async dateDetails => {
    let body = {
      date: dateDetails.date,
      user: userEmail,
      totalCalories: dateDetails.totalCalories,
      foods: dateDetails.foods
    };
    //console.log(userEmail);
    //return false;
    try {
      const res = await axios.post(`${server}/history`, body);
    } catch (err) {
      showError(
        "An error ocurred while sending your data to the reports portal." + err
      );
    }
  };

  saveOldDay = async (data, keepTodayData) => {
    let historyValue = [];
    try {
      historyData = await AsyncStorage.getItem("history");

      if (historyData !== null) {
        historyValue = JSON.parse(historyData) || [];
      }

      newFoods = [];

      data.foods.forEach(el => {
        if (el.selected > 0)
          newFoods.push({ name: el.name, cal: el.cal, selected: el.selected });
      });

      newHistory = {
        date: data.today,
        totalCalories: data.totalCalories,
        foods: newFoods
      };

      historyValue.push(newHistory);

      historyValue.forEach(element => {
        this.transmitDate(element);
      });

      AsyncStorage.setItem("history", []);

      if (!keepTodayData) {
        AsyncStorage.setItem(
          "todaysum",
          JSON.stringify({
            today: this.today(),
            totalCalories: 0,
            foods: [...this.state.foods]
          })
        );
      }

      this.setState({ history: historyValue });
    } catch (e) {
      showError(e.toString());
    }
  };

  componentDidMount = async () => {
    Orientation.lockToPortrait();

    try {
      await axios.get(`${server}/user/current`).then(res => {
        userEmail = res.data.email;
        userName = res.data.name;
      });
    } catch (err) {
      showError("An error ocurred:" + err);
    }

    this.state.foods.length <= 0 && this.loadFoods();
    //await AsyncStorage.clear();
    //return false;

    try {
      let historyValue = [];

      historyData = await AsyncStorage.getItem("history");
      if (historyData !== null) {
        historyValue = JSON.parse(historyData) || [];
      }

      this.setState({
        history: historyValue
      });

      const value = await AsyncStorage.getItem("todaysum");

      if (value !== null) {
        let data = JSON.parse(value) || [];

        if (data.today && data.today != this.today()) {
          this.saveOldDay(data, false);
        } else {
          let newFoods = data.foods;

          newFoods.forEach(el => (el.visible = true));

          this.setState({
            totalCalories: data.totalCalories,
            foods: newFoods
          });
        }
      }
    } catch (e) {
      showError(e.toString());
    }
  };

  tabs = [
    {
      key: "search",
      icon: "search",
      label: "Search",
      barColor: "#B71C1C",
      pressColor: "rgba(255, 255, 255, 0.16)"
    },
    {
      key: "categories",
      icon: "filter",
      label: "Categories",
      barColor: "#B71C1C",
      pressColor: "rgba(255, 255, 255, 0.16)"
    },
    {
      key: "history",
      icon: "line-chart",
      label: "KCL Report",
      barColor: "#B71C1C",
      pressColor: "rgba(255, 255, 255, 0.16)"
    }
  ];

  renderIcon = icon => ({ isActive }) => (
    <Icon size={24} color="white" name={icon} />
  );

  renderTab = ({ tab, isActive }) => (
    <FullTab
      isActive={isActive}
      key={tab.key}
      label={tab.label}
      renderIcon={this.renderIcon(tab.icon)}
    />
  );

  loadFoods = () => {
    foodList.sort((a, b) => (a.name > b.name ? 1 : b.name > a.name ? -1 : 0));
    this.setState({ foods: foodList });
  };

  launchMenu = async () => {
    if (this.state.history.length > 0) {
      try {
        let historyValue = [];

        historyData = await AsyncStorage.getItem("history");
        if (historyData !== null) {
          historyValue = JSON.parse(historyData) || [];
        }

        this.setState({
          history: historyValue
        });

        const value = await AsyncStorage.getItem("todaysum");

        if (value !== null) {
          let data = JSON.parse(value) || [];

          if (data.today && data.today != this.today()) {
            this.saveOldDay(data, true);
          }
        }
      } catch (err) {
        showError("An error ocurred" + err);
      }
    }
    this.props.navigation.dispatch(DrawerActions.openDrawer());
  };

  addCalories = async food => {
    let newFoods = [...this.state.foods];

    await newFoods.forEach(element => {
      if (food.name == element.name) {
        element.selected++;
      }
    });

    await this.setState({
      totalCalories: this.state.totalCalories + food.cal,
      foods: newFoods
    });

    try {
      AsyncStorage.setItem(
        "todaysum",
        JSON.stringify({
          today: this.today(),
          totalCalories: this.state.totalCalories,
          foods: [...this.state.foods]
        })
      );
    } catch (e) {
      showError(e.toString());
    }
  };

  removeCalories = async food => {
    if (food.selected <= 0) return false;
    let newFoods = [...this.state.foods];

    await newFoods.forEach(element => {
      if (food.name == element.name) {
        element.selected > 0 && element.selected--;
      }
    });

    await this.setState({
      totalCalories:
        this.state.totalCalories > food.cal
          ? this.state.totalCalories - food.cal
          : 0,
      foods: newFoods
    });

    try {
      AsyncStorage.setItem(
        "todaysum",
        JSON.stringify({
          today: this.today(),
          totalCalories: this.state.totalCalories,
          foods: [...this.state.foods]
        })
      );
    } catch (e) {
      showError(e.toString());
    }
  };

  search = async term => {
    let newFoods = [...this.state.foods];
    let result = [];

    await newFoods.forEach(element => {
      if (element.name.toLowerCase().indexOf(term.toLowerCase()) > -1) {
        element.visible = true;
      } else {
        element.visible = false;
      }

      result.push(element);
    });

    this.setState({
      foods: result,
      searchIsVisible: false,
      categoryIsVisible: false,
      historyIsVisible: false
    });
  };

  filterCategories = async categories => {
    this.setState({
      categoryIsVisible: false
    });

    let newFoods = [...this.state.foods];
    let result = [];
    await newFoods.forEach(element => {
      if (categories.indexOf(element.category.toLowerCase()) > -1) {
        element.visible = true;
      } else {
        element.visible = false;
      }
      result.push(element);
    });

    this.setState({
      foods: result
    });
  };

  showHistory = async () => {
    if (this.state.history.length > 0) {
      this.setState({ historyIsVisible: true });
    } else {
      showWarning("No record found");
    }
  };

  handleTabPress = tabPressed => {
    switch (tabPressed) {
      case "search":
        this.setState({ searchIsVisible: true });
        break;
      case "categories":
        this.setState({ categoryIsVisible: true });
        break;
      case "history":
        this.launchReport();
        break;
    }
  };

  launchReport = () => {
    Linking.canOpenURL(kclReportUrl).then(supported => {
      if (supported) {
        Linking.openURL(kclReportUrl);
      } else {
        showError("An error ocurred while opening kcl report.");
      }
    });
  };

  render() {
    return (
      <View style={styles.container}>
        <History
          isVisible={this.state.historyIsVisible}
          history={this.state.history}
          onCancel={() =>
            this.setState({
              historyIsVisible: false
            })
          }
        />
        <SearchFood
          isVisible={this.state.searchIsVisible}
          onSearch={this.search}
          onCancel={() =>
            this.setState({
              searchIsVisible: false
            })
          }
        />
        <CategoriesSelection
          isVisible={this.state.categoryIsVisible}
          onSelectCategories={this.filterCategories}
          onCancel={() =>
            this.setState({
              categoryIsVisible: false
            })
          }
        />
        <ImageBackground source={bg} style={styles.header}>
          <View style={styles.iconBar}>
            <TouchableOpacity onPress={() => this.launchMenu()}>
              <Icon name="bars" size={20} color="white" />
            </TouchableOpacity>
          </View>
          <Text style={styles.title}>KCL Counter</Text>
          <Text style={styles.calSum}>
            {`Total: ${this.state.totalCalories}`}
          </Text>
        </ImageBackground>

        <View style={styles.food}>
          <FlatList
            data={this.state.foods}
            keyExtractor={item => `${item.id}`}
            renderItem={({ item }) => (
              <Food
                {...item}
                addCalories={this.addCalories}
                removeCalories={this.removeCalories}
              />
            )}
          />
        </View>
        <BottomNavigation
          onTabPress={newTab => this.handleTabPress(newTab.key)}
          renderTab={this.renderTab}
          tabs={this.tabs}
        />
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#d6d6d6"
  },
  header: {
    flex: 3,
    backgroundColor: "#0b3345"
  },

  food: {
    flex: 13
  },
  title: {
    fontSize: 30,
    color: commonStyles.colors.default,
    fontFamily: commonStyles.fontLogo,
    textAlign: "center",
    marginRight: 5
  },
  calSum: {
    fontSize: 20,
    color: commonStyles.colors.default,
    fontFamily: commonStyles.fontCalc,
    textAlign: "right",
    marginRight: 10,
    paddingRight: 20
  },
  item: {
    fontSize: 20,
    margin: 5
  },
  iconBar: {
    marginTop: Platform.OS === "ios" ? 30 : 10,
    marginHorizontal: 20,
    flexDirection: "row",
    justifyContent: "space-between"
  }
});
