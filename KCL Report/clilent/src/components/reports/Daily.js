import React, { Component } from "react";
import { connect } from "react-redux";
import ListDailyDiet from "../grid/ListDailyDiet";
import { DropdownList } from "react-widgets";
import {
  getHistoryByMonth,
  getHistoryMonths
} from "../../actions/historyActions";

class Daily extends Component {
  constructor(props) {
    super(props);

    // Initialize the state
    this.state = {
      currentMonth: "",
      history: [],
      months: []
    };
  }

  // Change month async event
  changeMonth = async value => {
    
    // Get the data based on the new selected month
    await this.props.getHistoryByMonth(value);
    
    // Update the state with the data obtained
    this.setState({
      currentMonth: value,
      history: this.props.history.history.data
        .sort(function(a, b) {
          var dateA = new Date(a.date),
            dateB = new Date(b.date);
          return dateA - dateB;
        })
        .reverse()
    });
  };

  
  async componentWillMount() {
    let monthList = [];
    
    // Get the initial data to check the months available
    await this.props.getHistoryMonths();
    
    // Get the list of months based on the data
    monthList = this.props.history.history.data;
    
    // Set the last month available as the current
    let currentMonth = monthList[monthList.length - 1];

    // Get the last month history
    await this.props.getHistoryByMonth(currentMonth);

    // Update the state
    await this.setState({
      history: this.props.history.history.data
        .sort(function(a, b) {
          var dateA = new Date(a.date),
            dateB = new Date(b.date);
          return dateA - dateB;
        })
        .reverse(),
      months: monthList,
      currentMonth
    });
  }


  // Iterate through the data to fetch and render it
  getFullList = () => {
    let result = [];
    if (this.state.history.length > 0) {
      this.state.history.forEach(day => {
        result.push(
          <ListDailyDiet
            key={day.date}
            id={day.date}
            day={day.date}
            totalCalories={day.totalCalories}
            foods={day.foods}
          />
        );
      });
    }

    return result;
  };

  render() {
    return (
      <div className="row landing">
        <div className="col-md-12 text-center">
          <div className="lead">
            <h3>Select the month:</h3>

            <DropdownList
              data={this.state.months}
              value={this.state.currentMonth}
              onChange={value => this.changeMonth(value)}
            />
            <div className="fixed-panel">
              <div className="panel-group " id="accordion">
                <div className="panel panel-default ">
                  <div className="card card-grid">
                    {this.state.history != null &&
                      this.getFullList(this.props.history.history)}
                  </div>
                </div>
              </div>
            </div>
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
  { getHistoryByMonth, getHistoryMonths }
)(Daily);
