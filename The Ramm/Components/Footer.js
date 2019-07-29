import React, { Component } from "react";

class Presentation extends Component {
  render() {
    return (
      <div>
        <div className="container">
          <div className="row">
            <div className="col-sm-12 text-center">
              <div className="social-networks">
                <a href="#top" className="twitter">
                  <i className="fa fa-twitter" />
                </a>
                <a href="#top" className="facebook">
                  <i className="fa fa-facebook" />
                </a>
                <a href="#top" className="google">
                  <i className="fa fa-google-plus" />
                </a>
              </div>
            </div>
          </div>
        </div>
        <div className="footer-copyright">
          <p>
            The Ramm © 2018 Todos os direitos reservados <br />
            Criado por
            <a href="http://mateusgetulio.com">
              <strong> Mateus Getulio</strong>
            </a>
          </p>
        </div>
      </div>
    );
  }
}

export default Presentation;
