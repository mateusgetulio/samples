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

import commonStyles from "../../commonStyles";

export default class History extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <Modal
        onRequestClose={this.props.onCancel}
        visible={this.props.isVisible}
      >
        <TouchableWithoutFeedback onPress={this.props.onCancel}>
          <View style={styles.offset} />
        </TouchableWithoutFeedback>
        <View style={styles.container}>
          <FlatList
            data={this.props.history.reverse()}
            keyExtractor={item => `${item.date}`}
            renderItem={({ item }) => (
              <Text style={styles.input}>
                {`Date: ${
                  item.date
                } - Total Calories: ${item.totalCalories.toString()}`}
              </Text>
            )}
          />
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
    height: 400
  },
  offset: {
    flex: 1,
    backgroundColor: "rgba(0,0,0,0.7)"
  },
  input: {
    fontFamily: commonStyles.fontFamily,
    color: commonStyles.colors.secondary,
    width: "90%",
    fontSize: 19,
    paddingTop: 10,
    paddingLeft: 10
  }
});
