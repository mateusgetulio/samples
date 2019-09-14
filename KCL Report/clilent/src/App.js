import React, { Component } from "react";
import "./App.css";
import "@trendmicro/react-sidenav/dist/react-sidenav.css";
import Navbar from "./components/layout/Navbar";
import Sidebar from "./components/layout/Sidebar";
import Landing from "./components/layout/Landing";
import Graphs from "./components/graphs/Graphs";
import Yearly from "./components/reports/Yearly";
import Daily from "./components/reports/Daily";
import Monthly from "./components/reports/Monthly";
import { BrowserRouter as Router, Route } from "react-router-dom";
import jwt_decode from "jwt-decode";
import setAuthToken from "./utils/setAuthToken";
import { setCurrentUser, logoutUser } from "./actions/authActions";
import { clearCurrentProfile } from "./actions/profileActions";
import { Provider } from "react-redux";
import store from "./store";
import PrivateRoute from "./components/common/PrivateRoute";
import NotFound from "./components/not-found/NotFound";
import Register from "./components/auth/Register";
import Login from "./components/auth/Login";

// Check for token
if (localStorage.jwtToken) {
  // Set auth token header auth
  setAuthToken(localStorage.jwtToken);
  // Decode token and get user info and exp
  const decoded = jwt_decode(localStorage.jwtToken);
  // Set user and isAuthenticated
  store.dispatch(setCurrentUser(decoded));

  // Check for expired token
  const currentTime = Date.now() / 1000;
  if (decoded.exp < currentTime) {
    // Logout user
    store.dispatch(logoutUser());
    // Clear current Profile
    store.dispatch(clearCurrentProfile());
    // Redirect to login
    window.location.href = "/login";
  }
}

class App extends Component {
  render() {
    return (
      // Set the provider
      <Provider store={store}>
        // Wrap it with the router
        <Router>
          <div className="App">            
            <Navbar />
            // Set the private routes, requiring an authenticated user
            <PrivateRoute exact path="" component={Sidebar} />
            <div className="container">
              <Route exact path="/register" component={Register} />
              <Route exact path="/login" component={Login} />

              <PrivateRoute exact path="/dashboard" component={Landing} />
              <PrivateRoute exact path="/" component={Landing} />
              <PrivateRoute exact path="" component={Sidebar} />

              <PrivateRoute
                exact
                path="/graphs/donut"
                render={routeProps => <Graphs {...routeProps} type="donut" />}
              />
              <PrivateRoute
                exact
                path="/graphs/line"
                render={routeProps => <Graphs {...routeProps} type="line" />}
              />

              <PrivateRoute exact path="/reports/yearly" component={Yearly} />

              <PrivateRoute exact path="/reports/monthly" component={Monthly} />
              <PrivateRoute exact path="/reports/daily" component={Daily} />
              <PrivateRoute exact path="/reports" component={Daily} />

              <Route exact path="/not-found" component={NotFound} />
            </div>
          </div>
        </Router>
      </Provider>
    );
  }
}

export default App;
