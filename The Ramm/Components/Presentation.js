import React, { Component } from "react";

class Presentation extends Component {
  render() {
    return (
      <div className="container">
        <div className="col-sm-10 col-sm-offset-1">
          <div className="page-header text-center">
            <h1>A Banda</h1>
          </div>
          <p className="text-center">
            The Ramm é um grupo de 4 amigos que se juntaram para fazer o que
            mais amam, Rock 'n' Roll. <br />
            Atualmente estamos focados principalmente no trabalho de cover da
            banda Rammstein. <br />
            Entre 2016 e 2018 fizemos um total de 100 shows por todo Brasil.
          </p>
        </div>
      </div>
    );
  }
}

export default Presentation;
