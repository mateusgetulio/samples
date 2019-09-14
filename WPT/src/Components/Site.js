import React from "react";
import {
  StyleSheet,
  Text,
  View,
  TouchableWithoutFeedback,
  TouchableOpacity
} from "react-native";
import Icon from "react-native-vector-icons/FontAwesome";
import { getPerformanceColor } from "../../common";
import commonStyles from "../commonStyles";
import Swipeable from "react-native-swipeable";

export default props => {
  
  // Swipe left content
  const leftContent = (
    <View style={styles.exclude}>
      <Icon name="trash" size={22} color="#FFF" />
      <Text style={styles.excludeText}>Delete</Text>
    </View>
  );


  // Swipe right content
  const rightContent = [
    <TouchableOpacity
      style={[
        styles.exclude,
        { justifyContent: "flex-start", paddingLeft: 20 }
      ]}
      onPress={() => props.onDelete(props.id)}
    >
      <Icon name="trash" size={35} color="#FFF" />
    </TouchableOpacity>
  ];

  // Navigate to the website perfomance details
  const ViewSite = props => {
    props.navigation.navigate("ViewSite", { ...props });
  };

  return (
    <Swipeable
      leftActionActivationDistance={200}
      onLeftActionActivate={() => props.onDelete(props.id)}
      leftContent={leftContent}
      rightButtons={rightContent}
    >
      <View style={styles.container}>
        <View>
          <TouchableWithoutFeedback onPress={() => ViewSite(props)}>
            <View>
              <Text
                numberOfLines={1}
                ellipsizeMode={"tail"}
                style={styles.site}
              >
                {props.site}
              </Text>
              <Text
                numberOfLines={1}
                ellipsizeMode={"tail"}
                style={[
                  styles.score,
                  { color: getPerformanceColor(props.score) }
                ]}
              >
                Score: {props.score.toString()}%
              </Text>
            </View>
          </TouchableWithoutFeedback>
        </View>
      </View>
    </Swipeable>
  );
};

// View style
const styles = StyleSheet.create({
  container: {
    paddingVertical: 10,
    flexDirection: "row",
    borderBottomWidth: 1,
    borderColor: "#AAA"
  },
  site: {
    fontFamily: commonStyles.fontFamily,
    color: commonStyles.colors.mainText,
    fontWeight: "300",
    fontSize: 24,
    paddingLeft: 5
  },
  score: {
    fontFamily: commonStyles.fontFamily,
    fontWeight: "300",
    fontSize: 24,
    paddingLeft: 5
  },
  date: {
    fontFamily: commonStyles.fontFamily,
    color: commonStyles.colors.subText,
    fontSize: 12
  },
  exclude: {
    flex: 1,
    backgroundColor: "red",
    flexDirection: "row",
    justifyContent: "flex-end",
    alignItems: "center"
  },
  excludeText: {
    fontFamily: commonStyles.fontFamily,
    color: "#FFF",
    fontSize: 24,
    margin: 10
  }
});
