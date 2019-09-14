import React, { Component } from "react";
import {
  StyleSheet,
  Text,
  View,
  ImageBackground,
  TouchableOpacity,
  Alert
} from "react-native";
import Orientation from "react-native-orientation-locker";
import AsyncStorage from "AsyncStorage";
import axios from "axios";
import { server, showError } from "../../common";
import AuthInput from "../components/AuthInput";
import commonStyles from "../../commonStyles";
import backgroundImage from "../../assets/images/login.jpg";

export default class Auth extends Component {
  // Initialize the state
  state = {
    stageNew: false,
    name: "",
    email: "",
    password: "",
    confirmPassword: ""
  };

  componentDidMount() {
    // Lock to portrait mode
    Orientation.lockToPortrait();
  }

  // Signin method
  signin = async () => {
    // Send the login info, the password has been already encrypted
    try {
      const res = await axios.post(`${server}/user/login`, {
        email: this.state.email.toLowerCase(),
        password: this.state.password
      });

      // Store the user token
      axios.defaults.headers.common["Authorization"] = res.data.token;
      // Store the user info (email, name)
      AsyncStorage.setItem("userData", JSON.stringify(res.data));
      // Navigate home
      this.props.navigation.navigate("Home", res.data);
    } catch (err) {
      // Login failed
      Alert.alert("Login attempt failed", "User and/or password incorrect!");
      console.log(err);
    }
  };

  // Signup method
  signup = async () => {
    // Register the user
    try {
      await axios.post(`${server}/user/register`, {
        name: this.state.name,
        email: this.state.email,
        password: this.state.password,
        password2: this.state.confirmPassword
      });

      // After the user gets inserted, the app navigates to the login page
      Alert.alert("Sucess", "User added, please proceed to the login :)");
      this.setState({ stageNew: false });
    } catch (err) {
      showError(err);
    }
  };

  // Check which page to render
  signinOrSignup = () => {
    if (this.state.stageNew) {
      this.signup();
    } else {
      this.signin();
    }
  };

  render() {
    // Validate both the login and the register data
    const validations = [];

    validations.push(this.state.email && this.state.email.includes("@"));
    validations.push(this.state.password && this.state.password.length >= 6);

    if (this.state.stageNew) {
      validations.push(this.state.name && this.state.name.trim());
      validations.push(this.state.confirmPassword);
      validations.push(this.state.password === this.state.confirmPassword);
    }

    const validForm = validations.reduce((all, v) => all && v);

    return (
      <ImageBackground source={backgroundImage} style={styles.background}>
        <Text style={styles.title}>KCL Counter</Text>
        <View style={styles.formContainer}>
          <Text style={styles.subtitle}>
            {this.state.stageNew
              ? "Create your account"
              : "Enter your credentials"}
          </Text>
          {this.state.stageNew && (
            <AuthInput
              icon="user"
              placeholder="Name"
              style={styles.input}
              value={this.state.name}
              onChangeText={name => this.setState({ name })}
            />
          )}
          <AuthInput
            icon="at"
            placeholder="E-mail"
            style={styles.input}
            value={this.state.email}
            onChangeText={email => this.setState({ email })}
          />
          <AuthInput
            icon="lock"
            secureTextEntry={true}
            placeholder="Password"
            style={styles.input}
            value={this.state.password}
            onChangeText={password => this.setState({ password })}
          />
          {this.state.stageNew && (
            <AuthInput
              icon="asterisk"
              secureTextEntry={true}
              placeholder="Confirm the password"
              style={styles.input}
              value={this.state.confirmPassword}
              onChangeText={confirmPassword =>
                this.setState({ confirmPassword })
              }
            />
          )}
          <TouchableOpacity disabled={!validForm} onPress={this.signinOrSignup}>
            <View
              style={[
                styles.button,
                !validForm ? { backgroundColor: "#AAA" } : {}
              ]}
            >
              <Text style={styles.buttonText}>
                {this.state.stageNew ? "Register" : "Login"}
              </Text>
            </View>
          </TouchableOpacity>
        </View>
        <TouchableOpacity
          style={{ padding: 10 }}
          onPress={() =>
            this.setState({
              stageNew: !this.state.stageNew
            })
          }
        >
          <Text style={styles.buttonText}>
            {this.state.stageNew
              ? "Already have an account?"
              : "Don't have an account yet?"}
          </Text>
        </TouchableOpacity>
      </ImageBackground>
    );
  }
}

// View style
const styles = StyleSheet.create({
  background: {
    flex: 1,
    width: "100%",
    alignItems: "center",
    justifyContent: "center"
  },
  title: {
    fontFamily: commonStyles.fontLogo,
    color: "#FFF",
    paddingLeft: 18,
    fontSize: 70,
    marginBottom: 10
  },
  subtitle: {
    fontFamily: commonStyles.fontFamily,
    color: "#FFF",
    fontSize: 20
  },
  formContainer: {
    backgroundColor: "rgba(0,0,0,0.8)",
    padding: 20,
    width: "90%"
  },
  input: {
    marginTop: 10,
    backgroundColor: "#FFF"
  },
  button: {
    backgroundColor: "#080",
    marginTop: 10,
    padding: 10,
    alignItems: "center"
  },
  buttonText: {
    fontFamily: commonStyles.fontFamily,
    color: "#FFF",
    fontSize: 20
  }
});
