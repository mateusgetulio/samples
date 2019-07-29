import React, { Component } from "react";
import {
  View,
  Text,
  Modal,
  TextInput,
  TouchableWithoutFeedback,
  TouchableOpacity,
  StyleSheet
} from "react-native";
import commonStyles from "../../commonStyles";

export default class SearchFood extends Component {
  constructor(props) {
    super(props);
    this.state = this.getInitialState();
  }

  getInitialState = () => {
    return {
      food: ""
    };
  };

  search = () => {
    console.log("aquin");
    this.props.onSearch(this.state.food);
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
          <TextInput
            style={styles.input}
            placeholder="Enter a food..."
            onChangeText={food => this.setState({ food })}
            value={this.state.food}
          />

          <View
            style={{
              flexDirection: "row",
              justifyContent: "flex-end",
              paddingBottom: 10
            }}
          >
            <TouchableOpacity onPress={this.search}>
              <Text style={styles.button}>Search</Text>
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
    height: 150
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
    width: "90%",
    fontSize: 22
  }
});
