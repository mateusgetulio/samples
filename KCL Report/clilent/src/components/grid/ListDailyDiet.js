import React, { Component } from "react";

class ListDailyDiet extends Component {
  
  // Prepares the list of food iterating through the data
  getFoodList = foods => {
    let result = [];

    foods.forEach(food => {
      result.push(
        <div key={Math.random()}>
          {" "}
          {`${food.name} ${food.cal} kcal - selected: ${food.selected}`}{" "}
        </div>
      );
    });

    return result;
  };
  render() {
    return (
      <div>
        <div className="panel-heading">
          <h4 className="panel-title">
            <a
              className="accordion-toggle"
              data-toggle="collapse"
              data-parent="#accordion"
              href={`#collapse${this.props.id}`}
            >
              {`${
                this.props.day
              } - Total calories: ${new Intl.NumberFormat().format(
                this.props.totalCalories
              )}`}
            </a>
          </h4>
        </div>
        <div
          id={`collapse${this.props.id}`}
          className="panel-collapse collapse in"
        >
          <div className="panel-body">{this.getFoodList(this.props.foods)}</div>
        </div>
        <br />
      </div>
    );
  }
}

export default ListDailyDiet;
