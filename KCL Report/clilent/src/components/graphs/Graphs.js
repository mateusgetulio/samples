import React, { Component } from "react";
import Chart from "react-apexcharts";
import "react-widgets/dist/css/react-widgets.css";
import { DropdownList } from "react-widgets";
import { getMonths } from "../../common";
import { connect } from "react-redux";
import { getHistory } from "../../actions/historyActions";

let dates = [];
let totalCal = [];
let months = [];
let data = [];

class Graphs extends Component {
  
  // Function to fetch the graph data
  fetchData(data) {
    dates = [];
    totalCal = [];
    
    // Filter the data based on the month
    // and update the total number of calories
    data.forEach(el => {
      if (
        this.state.reportMonth &&
        el.date.indexOf(this.state.reportMonth) > -1
      ) {
        dates.push(el.date.match(/([0-9]+)($|\n)/)[0]);
        totalCal.push(el.totalCalories);
      }
    });

    
    // Update the state with the data that was fetched
    this.setState({
      optionsDonut: {
        labels: dates
      },

      seriesDonut: totalCal,
      optionsLine: {
        xaxis: {
          categories: dates
        },
        chart: {
          toolbar: {
            show: false
          }
        }
      },
      seriesLine: [
        {
          name: "series-1",
          data: totalCal
        }
      ]
    });
  }

  // Async function to update the graphs
  updateGraphs = async value => {
    await this.setState({ reportMonth: value });
    await this.fetchData(data);
  };


  componentDidMount = async () => {
    // Get the initial data to be rendered and displayed
    await this.props.getHistory();
    data = this.props.history.history.data;

    // Get the list of months based on the data that was fetched
    months = getMonths(data);

    // Set the last month available as the current month
    await this.setState({ reportMonth: months[months.length - 1] });

    // Fetch the data gathered
    this.fetchData(data);
  };

  constructor(props) {
    super(props);


    // Initialize the state
    this.state = {
      reportMonth: "",
      optionsDonut: {
        labels: dates
      },

      seriesDonut: totalCal,
      optionsLine: {
        xaxis: {
          categories: dates
        },
        chart: {
          toolbar: {
            show: false
          }
        }
      },
      seriesLine: [
        {
          name: "series-1",
          data: totalCal
        }
      ]
    };
  }


  render() {
    return (
      <div className="row landing">
        <div className="col-md-12 text-center">
          <div className="col-md-12 text-center">
            <br />
            <div className="lead">
              <h3>Select the month:</h3>

              <DropdownList
                data={months}
                value={this.state.reportMonth}
                onChange={value => this.updateGraphs(value)}
              />
            </div>
            {this.props.type === "donut" && (
              <div className="card">
                <div className="col-md-8 col-sd-12 text-center">
                  <Chart
                    options={this.state.optionsDonut}
                    series={this.state.seriesDonut}
                    labels={this.state.labelsDonut}
                    type="donut"
                  />
                </div>
              </div>
            )}
            {this.props.type === "line" && (
              <div className="card">
                <div className="col-md-8 col-sd-12 text-center">
                  <Chart
                    options={this.state.optionsLine}
                    series={this.state.seriesLine}
                    type="line"
                  />
                </div>
              </div>
            )}
          </div>
        </div>
      </div>
    );
  }
}


// Redux map
const mapStateToProps = state => ({
  history: state.history
});

export default connect(
  mapStateToProps,
  { getHistory }
)(Graphs);
