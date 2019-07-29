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
import commonStyles from "../CommonStyles";
import { confirmAction, delay } from "../../common";

export default class AddSite extends Component {
  state = { dots: "." };
  constructor(props) {
    super(props);
  }

  moveDots = async () => {
    while (this.props.isVisible) {
      await delay(500);
      this.state.dots.length < 8
        ? this.setState({ dots: this.state.dots + "." })
        : this.setState({ dots: "." });
    }
  };

  render() {
    return (
      <Modal
        onRequestClose={this.props.onCancel}
        visible={this.props.isVisible}
        onShow={() => this.moveDots()}
      >
        <TouchableWithoutFeedback onPress={this.props.onCancel}>
          <View style={styles.offset} />
        </TouchableWithoutFeedback>
        <View style={styles.container}>
          <TextInput style={styles.info}>
            {`Testing site ${this.props.current} of ${this.props.total} ${
              this.state.dots
            }`}
          </TextInput>
          <View style={{ flexDirection: "row" }}>
            <TextInput style={styles.subinfo}>
              Please wait, this step can take some minutes.
            </TextInput>
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
    flexDirection: "column",
    justifyContent: "center",
    height: 160
  },
  offset: {
    flex: 1,
    backgroundColor: "rgba(0,0,0,0.7)"
  },
  info: {
    fontFamily: commonStyles.fontFamily,
    fontSize: 24,
    marginLeft: 10
  },
  subinfo: {
    fontFamily: commonStyles.fontFamily,
    fontSize: 18,
    flexWrap: "wrap",
    marginLeft: 10
  }
});
