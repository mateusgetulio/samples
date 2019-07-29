import React, { Component } from "react";

import Grid from "../common/layout/grid";
import Row from "../common/layout/row";
import ValueBox from "../common/widget/valueBox";

export default ({ credit, debt }) => (
  <Grid cols="12">
    <fieldset>
      <legend>Summary</legend>
      <Row>
        <ValueBox
          cols="12 4"
          color="green"
          icon="bank"
          value={`$ ${credit}`}
          text="Credits total"
        />
        <ValueBox
          cols="12 4"
          color="red"
          icon="credit-card"
          value={`$ ${debt}`}
          text="Debts total"
        />
        <ValueBox
          cols="12 4"
          color="blue"
          icon="money"
          value={`$ ${credit - debt}`}
          text="Consolidated"
        />
      </Row>
    </fieldset>
  </Grid>
);
