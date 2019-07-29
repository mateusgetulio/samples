import React, { Component } from "react";

class Members extends Component {
  render() {
    return (
      <div className="container">
        <div className="row ">
          <div className="col-sm-3">
            <div className="card">
              <canvas
                className="header-bg"
                width="250"
                height="70"
                id="header-blur"
              />
              <div className="avatar">
                <img src="" alt="" />
              </div>
              <div className="content">
                <p>
                  <br />
                  Henry <br />
                  Vocalista <br />
                  <br />
                </p>
              </div>
            </div>
          </div>
          <div className="col-sm-3">
            <div className="card">
              <canvas
                className="header-bg"
                width="250"
                height="70"
                id="header-blur"
              />
              <div className="avatar">
                <img src="" alt="" />
              </div>
              <div className="content">
                <p>
                  <br />
                  Léo <br />
                  Baixista <br />
                  <br />
                </p>
              </div>
            </div>
          </div>
          <div className="col-sm-3">
            <div className="card">
              <canvas
                className="header-bg"
                width="250"
                height="70"
                id="header-blur"
              />
              <div className="avatar">
                <img src="" alt="" />
              </div>
              <div className="content">
                <p>
                  <br />
                  Ramon <br />
                  Guitarrista <br />
                  <br />
                </p>
              </div>
            </div>
          </div>
          <div className="col-sm-3">
            <div className="card">
              <canvas
                className="header-bg"
                width="250"
                height="70"
                id="header-blur"
              />
              <div className="avatar">
                <img src="" alt="" />
              </div>
              <div className="content">
                <p>
                  <br />
                  Lenny <br />
                  Baterista <br />
                  <br />
                </p>
              </div>
            </div>
          </div>
        </div>
        <br />
        <br />
        <br />
      </div>
    );
  }
}

export default Members;
