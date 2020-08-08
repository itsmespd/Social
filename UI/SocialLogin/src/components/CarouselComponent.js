import React from "react";
import Carousel from "react-bootstrap/Carousel";
import brothers from "../resources/brothers.jpg";
import diversity from "../resources/diversity.jpg";
import diversityHand from "../resources/diversity-hand.jpg";
import flagGround from "../resources/flagGround.jpg";
import indianSwiss from "../resources/indiaSwiss.jpg";
import unityVector from "../resources/unityVector.jpg";

class CarouselComponent extends React.Component {
  render() {
    return (
      <Carousel>
        <Carousel.Item>
          <img className="d-block w-100" src={brothers} alt="First slide" />
          <Carousel.Caption>
            <h3>First slide label</h3>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
          </Carousel.Caption>
        </Carousel.Item>
        <Carousel.Item>
          <img className="d-block w-100" src={diversity} alt="Third slide" />

          <Carousel.Caption>
            <h3>Second slide label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </Carousel.Caption>
        </Carousel.Item>
        <Carousel.Item>
          <img className="d-block w-100" src={unityVector} alt="Third slide" />
          <Carousel.Caption>
            <h3>Third slide label</h3>
            <p>
              Praesent commodo cursus magna, vel scelerisque nisl consectetur.
            </p>
          </Carousel.Caption>
        </Carousel.Item>
      </Carousel>
    );
  }
}

export default CarouselComponent;
