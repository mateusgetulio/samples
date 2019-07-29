import React, { Component } from "react";

class IntermediaryText extends Component {
  render() {
    return (
      <section className={this.props.styleName}>
        <div className="col-sm-6 col-sm-offset-3 text-center">
          <h2>{this.props.text}</h2>
        </div>
      </section>
    );
  }
}

export default IntermediaryText;
