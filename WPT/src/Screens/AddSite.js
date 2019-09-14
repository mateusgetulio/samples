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
import commonStyles from "../commonStyles";
import { showError } from "../../common";

export default class AddSite extends Component {
  constructor(props) {
    super(props);
    this.state = this.getInitialState();
  }

  // Initializes the state
  getInitialState = () => {
    return {
      site: ""
    };
  };

  // Save method
  save = () => {
    // Validates to check if the input corresponds to a website
    if (
      !this.state.site.trim() ||
      !/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(
        this.state.site.toLowerCase()
      )
    ) {
      showError("Please enter a valid website");
      return;
    }


    // Pass the data along to be saved
    const data = { ...this.state };
    this.props.onSave(data);
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
            placeholder="Website"
            onChangeText={site => this.setState({ site })}
            value={this.state.site}
          />

          <View style={{ flexDirection: "row", justifyContent: "flex-end" }}>
            <TouchableOpacity onPress={this.props.onCancel}>
              <Text style={styles.button}>Cancel</Text>
            </TouchableOpacity>
            <TouchableOpacity onPress={this.save}>
              <Text style={styles.button}>Save</Text>
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

// View style
var styles = StyleSheet.create({
  container: {
    backgroundColor: "white",
    justifyContent: "space-between",
    height: 100
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
