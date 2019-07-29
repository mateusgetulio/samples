import React, { Component } from "react";

class Menu extends Component {
  render() {
    return (
      <div className="navbar navbar-inverse navbar-default" id="nav">
        <div className="container">
          <div className="navbar-header">
            <button
              type="button"
              className="navbar-toggle"
              data-toggle="collapse"
              data-target=".navbar-collapse"
            >
              <span className="icon-bar" />
              <span className="icon-bar" />
              <span className="icon-bar" />
            </button>
          </div>
          <div className="collapse navbar-collapse">
            <ul className="nav navbar-nav nav-justified">
              <li>
                <a href="#home">Home</a>
              </li>
              <li>
                <a href="#section1">A Banda</a>
              </li>
              <li>
                <a href="#section2">Agenda</a>
              </li>
              <li>
                <a href="#section3">Contato</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    );
  }
}

export default Menu;
