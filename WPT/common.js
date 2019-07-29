import { Alert, Platform } from "react-native";
import commonStyles from "./src/CommonStyles";

const localServer =
  Platform.OS === "ios" ? "http://localhost:3000" : "http://10.0.2.2:3000";

const server = "https://www.webpagetest.org";
const sitesLimit = 5;

function showError(err) {
  err.length < 300 ? (limit = err.length) : (limit = 300);
  try {
    Alert.alert("Ops! An error ocurred!", `${err.substring(0, limit)}...`);
  } catch (err) {}
}

function showWarning(err) {
  err.length < 300 ? (limit = err.length) : (limit = 300);
  try {
    Alert.alert("Attention!", `${err.substring(0, limit)}...`);
  } catch (err) {}
}

function confirmAction(title, message, yesAction) {
  Alert.alert(title, message, [
    {
      text: "NO",
      style: "cancel"
    },
    { text: "YES", onPress: () => yesAction() }
  ]);
}

function getScore(loadTime, firstByte, bytesIn, cdnScore) {
  let score = 100;

  firstByteFactor = firstByte - 500;
  firstByteFactor < 1
    ? (firstByteFactor = 0)
    : (firstByteFactor = firstByteFactor / 15);
  firstByteFactor > 20 ? (score -= 20) : (score -= firstByteFactor);

  loadTimeFactor = loadTime - 3000;
  loadTimeFactor < 1
    ? (loadTimeFactor = 0)
    : (loadTimeFactor = loadTimeFactor / 15 / 100);
  loadTimeFactor > 40 ? (score -= 40) : (score -= loadTimeFactor);

  bytesInFactor = 90 - bytesIn / loadTime;
  if (bytesInFactor < 1) bytesInFactor = 0;
  bytesInFactor > 20 ? (score -= 20) : (score -= bytesInFactor);

  cdnScoreFactor = 100 - cdnScore;
  if (cdnScoreFactor < 1) cdnScoreFactor = 0;

  cdnScoreFactor > 20 ? (score -= 20) : (score -= cdnScoreFactor);

  return Math.round(score);
}

function delay(ms) {
  return new Promise(res => setTimeout(res, ms));
}

function getCdnLevel(cdnScore) {
  switch (true) {
    case cdnScore < 20:
      return "Not present";
    case cdnScore < 60:
      return "Partially present";
    case cdnScore < 80:
      return "Good usage";
    case cdnScore > 81:
      return "Excellent usage";
  }
}

function getPerformanceColor(score) {
  switch (true) {
    case score > 85:
      return commonStyles.colors.great;
    case score > 70:
      return commonStyles.colors.good;
    case score > 50:
      return commonStyles.colors.regular;
    case score >= 20:
      return commonStyles.colors.bad;
    case score < 20 && score > 0:
      return commonStyles.colors.awful;
    default:
      return commonStyles.colors.mainText;
  }
}

export {
  server,
  showError,
  showWarning,
  sitesLimit,
  getPerformanceColor,
  confirmAction,
  getScore,
  getCdnLevel,
  delay
};
