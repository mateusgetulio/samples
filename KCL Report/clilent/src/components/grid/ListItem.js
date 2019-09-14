import React, { Component } from "react";

// List item component
class ListItem extends Component {
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
              {this.props.year || this.props.month}
            </a>
          </h4>
        </div>
        <div
          id={`collapse${this.props.id}`}
          className="panel-collapse collapse in"
        >
          <div className="panel-body">
            {`Total calories: ${new Intl.NumberFormat().format(
              this.props.totalCalories
            )}`}
            <br />
            {`Daily average: ${new Intl.NumberFormat().format(
              this.props.averageCalories
            )}`}
            <br />
            {`Favorite food: ${this.props.favoriteFoods}`} <br />
            <br />
          </div>
        </div>
      </div>
    );
  }
}

export default ListItem;
