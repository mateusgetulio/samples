import React, { Component } from "react";
import {
  View,
  Text,
  Modal,
  TextInput,
  TouchableWithoutFeedback,
  TouchableOpacity,
  FlatList,
  StyleSheet
} from "react-native";
import { CheckBox } from "react-native-elements";

import commonStyles from "../../commonStyles";

categories = [
  "Dessert",
  "Biscuit",
  "Pasta",
  "Vegetable",
  "Cereal",
  "Sea food",
  "Fruit",
  "Sauce",
  "Dairy",
  "Candy",
  "Snack",
  "Bean",
  "Meat"
];

export default class CategoriesSelection extends Component {
  constructor(props) {
    super(props);
    this.state = this.getInitialState();
  }

  getInitialState = () => {
    categories.sort();
    return {
      selection: categories.map(el => el.toLowerCase()),
      selectionText: "Clear"
    };
  };

  processCategories = () => {
    this.props.onSelectCategories(this.state.selection);
  };

  multiSelect = () => {
    this.state.selection.length > 0
      ? this.setState({ selection: [], selectionText: "Select all" })
      : this.setState({
          selection: categories.map(el => el.toLowerCase()),
          selectionText: "Clear"
        });
  };

  handleCheckChange = category => {
    var index = this.state.selection.indexOf(category);
    newSelection = this.state.selection;

    if (index > -1) {
      newSelection.splice(index, 1);
    } else {
      newSelection.push(category);
    }

    this.state.selection.length > 0
      ? (selectionText = "Clear")
      : (selectionText = "Select all");

    this.setState({ selection: newSelection, selectionText: selectionText });
  };

  render() {
    return (
      <Modal
        onRequestClose={this.props.onCancel}
        visible={this.props.isVisible}
        onShow={() => this.setState({ ...this.getInitialState() })}
      >
        <TouchableWithoutFeedback onPress={this.props.onCancel}>
          <View style={styles.offset} />
        </TouchableWithoutFeedback>
        <View style={styles.container}>
          <View style={{ flexDirection: "row", justifyContent: "flex-start" }}>
            <TouchableOpacity onPress={() => this.multiSelect()}>
              <Text style={styles.smallButton}>{this.state.selectionText}</Text>
            </TouchableOpacity>
          </View>
          <FlatList
            data={categories}
            extraData={this.state}
            keyExtractor={item => `${item}`}
            renderItem={({ item }) => (
              <CheckBox
                title={item}
                checked={this.state.selection.indexOf(item.toLowerCase()) > -1}
                onPress={() => this.handleCheckChange(item.toLowerCase())}
              />
            )}
          />

          <View style={{ flexDirection: "row", justifyContent: "flex-end" }}>
            <TouchableOpacity onPress={this.processCategories}>
              <Text style={styles.button}>Filter</Text>
            </TouchableOpacity>
            <TouchableOpacity onPress={this.props.onCancel}>
              <Text style={styles.button}>Cancel</Text>
            </TouchableOpacity>
          </View>
        </View>
        <TouchableWithoutFeedback onPress={this.props.onCancel}>
          <View style={styles.offset} />
        </TouchableWithoutFeedback>
      </Modal>
    );
  }
}

var styles = StyleSheet.create({
  container: {
    backgroundColor: "white",
    justifyContent: "space-between",
    height: 350
  },
  offset: {
    flex: 1,
    backgroundColor: "rgba(0,0,0,0.7)"
  },
  button: {
    margin: 20,
    marginRight: 30,
    color: commonStyles.colors.action,
    fontSize: 20
  },
  smallButton: {
    marginLeft: 13,
    marginTop: 5,
    color: commonStyles.colors.action,
    fontSize: 16
  },
  header: {
    fontFamily: commonStyles.fontFamily,
    backgroundColor: commonStyles.colors.default,
    color: commonStyles.colors.secondary,
    textAlign: "center",
    padding: 15,
    fontSize: 22
  },
  input: {
    fontFamily: commonStyles.fontFamily,
    color: commonStyles.colors.secondary,
    width: "90%",
    fontSize: 22
  }
});
