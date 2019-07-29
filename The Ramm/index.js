import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import Menu from "./Components/Menu";
import Header from "./Components/Header";
import Presentation from "./Components/Presentation";
import Members from "./Components/Members";
import Band from "./Components/Band";
import IntermediaryText from "./Components/IntermediaryText";
import Agenda from "./Components/Agenda";
import Contact from "./Components/Contact";
import Scroll from "./Components/Scroll";
import Footer from "./Components/Footer";

import * as serviceWorker from "./serviceWorker";

ReactDOM.render(<Menu />, document.getElementById("menu"));
ReactDOM.render(<Header />, document.getElementById("header"));
ReactDOM.render(<Presentation />, document.getElementById("presentation"));
ReactDOM.render(
  <IntermediaryText
    styleName="bg-1"
    text="Rock 'n' Roll não se aprende nem se ensina."
  />,
  document.getElementById("it1")
);
ReactDOM.render(<Members />, document.getElementById("members"));
ReactDOM.render(<Band />, document.getElementById("band"));
ReactDOM.render(<Agenda />, document.getElementById("agenda"));

ReactDOM.render(
  <IntermediaryText
    styleName="bg-3"
    text="Os pintores tem as telas. Os escritores, os papéis em branco. Os músicos tem o silêncio."
  />,
  document.getElementById("it2")
);
ReactDOM.render(<Contact />, document.getElementById("contact"));
ReactDOM.render(<Scroll />, document.getElementById("scroll"));
ReactDOM.render(<Footer />, document.getElementById("footer"));

serviceWorker.unregister();
