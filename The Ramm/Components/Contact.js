import React, { Component } from "react";

class Contact extends Component {
  render() {
    return (
      <div>
        <div className="row">
          <div className="col-sm-8 col-sm-offset-2 text-center">
            <h1>Contato</h1>
            <br />
            <br />
            <p>
              Para tirar dúvidas e solicitar agendamentos de shows, entre em
              contato conosco pelos meios de comunicação abaixo.
            </p>
          </div>
        </div>

        <div className="container">
          <div className="row">
            <div className="col-sm-4">
              <h3>Nos envie sua mensagem.</h3>
              <hr />
              <address>
                <strong>Email:</strong>
                <a href="mailto:#"> bandatherammcover@gmail.com</a>
                <br />
                <br />
                <strong>Telefone:</strong> (12) 3123-0000
              </address>
            </div>
            <div className="col-sm-8 contact-form">
              <form id="contact" method="post" className="form">
                <div className="row">
                  <div className="col-xs-6 col-md-6 form-group">
                    <input
                      className="form-control"
                      id="name"
                      name="name"
                      placeholder="Nome"
                      type="text"
                      required
                    />
                  </div>
                  <div className="col-xs-6 col-md-6 form-group">
                    <input
                      className="form-control"
                      id="email"
                      name="email"
                      placeholder="Email"
                      type="email"
                      required
                    />
                  </div>
                </div>
                <textarea
                  className="form-control"
                  id="message"
                  name="message"
                  placeholder="Mensagem"
                  rows="5"
                />
                <br />
                <div className="row">
                  <div className="col-xs-12 col-md-12 form-group">
                    <button
                      className="btn btn-primary pull-right"
                      type="submit"
                    >
                      Enviar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default Contact;
