import React, { Component } from "react";

class Scroll extends Component {
  componentDidMount() {
    var addScript = document.createElement("script");
    addScript.setAttribute("src", "./scripts.js");
    document.body.appendChild(addScript);
  }

  render() {
    return (
      <ul className="nav pull-right scroll-top">
        <li>
          <a href="#" title="Scroll to top">
            <i className="glyphicon glyphicon-chevron-up" />
          </a>
        </li>
        <script type="text/javascript" src="../scripts.js" />
      </ul>
    );
  }
}

export default Scroll;
