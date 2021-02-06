import React from "react";
import Button from "react-bootstrap/Button";

class FooterTerms extends React.Component {
  render() {
    return (
      <div>
        <h1>All Rights Reserved!</h1>
        <h5 style={{ color: "#f57b42" }}>Application Of The People</h5>
        <h5 style={{ color: "#0390fc" }}>Application For The People</h5>
        <h5 style={{ color: "#31e834" }}>Application By The People</h5>
        <a href="#home"> Terms and Conditions</a>
        <br />
        <br />
        <Button variant="primary">Learn more</Button>
      </div>
    );
  }
}

export default FooterTerms;
