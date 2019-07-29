import React, { Component } from "react";

class Header extends Component {
  render() {
    return (
      <header
        className="masthead carousel fade-carousel slide"
        data-ride="carousel"
        data-interval="6000"
        id="bs-carousel"
      >
        <ol className="carousel-indicators">
          <li data-target="#bs-carousel" data-slide-to="0" className="active" />
          <li data-target="#bs-carousel" data-slide-to="1" />
          <li data-target="#bs-carousel" data-slide-to="2" />
        </ol>

        <div className="carousel-inner">
          <div className="item slides active">
            <div className="slide-1" />
            <div className="hero">
              <hgroup>
                <h2>THE RAMM</h2>
              </hgroup>
            </div>
          </div>
          <div className="item slides">
            <div className="slide-2" />
            <div className="hero">
              <hgroup>
                <h2>THE RAMM</h2>
              </hgroup>
            </div>
          </div>
          <div className="item slides">
            <div className="slide-3" />
            <div className="hero">
              <hgroup>
                <h2>THE RAMM</h2>
              </hgroup>
            </div>
          </div>
        </div>

        <a
          href="#bs-carousel"
          className="left carousel-control"
          data-slide="prev"
        >
          <span className="glyphicon glyphicon-chevron-left" />
        </a>
        <a
          href="#bs-carousel"
          className="right carousel-control"
          data-slide="next"
        >
          <span className="glyphicon glyphicon-chevron-right" />
        </a>
      </header>
    );
  }
}

export default Header;
