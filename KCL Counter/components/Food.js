import React, { Component } from "react";
import { Card, ListItem, Button } from "react-native-elements";
import {
  Platform,
  StyleSheet,
  Text,
  TextInput,
  TouchableWithoutFeedback,
  Alert,
  View,
  FlatList
} from "react-native";
import Icon from "react-native-vector-icons/FontAwesome";
import commonStyles from "../../commonStyles";

// Food component
export default props => {
  // Checks if food isn't being filtered
  if (props.visible == false) {
    return false;
  } else {
    return (
      <Card
        titleStyle={styles.titleCard}
        title={`${props.name} - Selected: ${props.selected}`}
        image={props.image}
        imageStyle={styles.image}
      >
        <View style={styles.container}>
          <Text style={styles.info}>{props.description}</Text>
          <Text style={styles.info}>{`${props.cal} kcal`}</Text>
        </View>
        <View style={styles.buttonContainer}>
          <Button
            onPress={() => props.addCalories({ ...props })}
            icon={<Icon name="plus-circle" color="#ffffff" />}
            buttonStyle={[styles.button, styles.action]}
          />
          <Button
            onPress={() => props.removeCalories({ ...props })}
            icon={<Icon name="minus-circle" color="#fff" />}
            buttonStyle={[styles.button, styles.negativeAction]}
          />
        </View>
      </Card>
    );
  }
};

// Component style
const styles = StyleSheet.create({
  titleCard: {
    fontFamily: commonStyles.fontFamily,
    fontSize: 20
  },
  image: {},
  container: {},
  buttonContainer: {
    flexDirection: "row"
  },
  button: {
    borderRadius: 0,
    marginBottom: 0,
    paddingRight: 20,
    paddingLeft: 20
  },
  info: { marginBottom: 10, fontFamily: commonStyles.fontFamily },
  action: { backgroundColor: commonStyles.colors.action },
  negativeAction: { backgroundColor: commonStyles.colors.negativeAction }
});
