import React, { Component } from "react";

class Agenda extends Component {
  render() {
    return (
      <div className="col-sm-8 col-sm-offset-2 text-center">
        <h1>Agenda</h1>
        <p className="lead">Confira os shows agendados para este mês.</p>
        <hr />
        <div className="agenda">
          <div className="table-responsive">
            <table className="table table-condensed table-bordered">
              <thead>
                <tr>
                  <th className="text-center">Dia</th>
                  <th className="text-center">Horário</th>
                  <th className="text-center">Local</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td className="agenda-date active" rowSpan="1">
                    <div className="dayofmonth">8</div>
                    <div className="dayofweek">Sábado</div>
                  </td>
                  <td className="agenda-time">19:30</td>
                  <td className="agenda-events">
                    <div className="agenda-event">Benjamin Rock Bar</div>
                  </td>
                </tr>

                <tr>
                  <td className="agenda-date active" rowSpan="3">
                    <div className="dayofmonth">16</div>
                    <div className="dayofweek">Domingo</div>
                  </td>
                  <td className="agenda-time">13:00</td>
                  <td className="agenda-events">
                    <div className="agenda-event">On The Rocks</div>
                  </td>
                </tr>
                <tr>
                  <td className="agenda-time">16:00</td>
                  <td className="agenda-events">
                    <div className="agenda-event">Lion's Music Bar</div>
                  </td>
                </tr>
                <tr>
                  <td className="agenda-time">23:00</td>
                  <td className="agenda-events">
                    <div className="agenda-event">Armazém XV</div>
                  </td>
                </tr>
                <tr>
                  <td className="agenda-date active" rowSpan="1">
                    <div className="dayofmonth">21</div>
                    <div className="dayofweek">Sexta</div>
                  </td>
                  <td className="agenda-time">00:00</td>
                  <td className="agenda-events">
                    <div className="agenda-event">Che Loco</div>
                  </td>
                </tr>
                <tr>
                  <td className="agenda-date active" rowSpan="1">
                    <div className="dayofmonth">22</div>
                    <div className="dayofweek">Sábado</div>
                  </td>
                  <td className="agenda-time">22:30</td>
                  <td className="agenda-events">
                    <div className="agenda-event">O'Connell Pub</div>
                  </td>
                </tr>
                <tr>
                  <td className="agenda-date active" rowSpan="1">
                    <div className="dayofmonth">23</div>
                    <div className="dayofweek">Domingo</div>
                  </td>
                  <td className="agenda-time">17:00</td>
                  <td className="agenda-events">
                    <div className="agenda-event">Oficina Bar</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div className="alert alert-warning">
          <h4>Lista de eventos completa</h4>
          <p>
            Para ficar por dentro da nossa agenda completa visite a nossa página
            no Facebook:
          </p>
          <p>
            <a href="http://facebook.com/bandacovertheramm">Banda The Ramm</a>
          </p>
        </div>
      </div>
    );
  }
}

export default Agenda;
