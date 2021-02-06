import React from 'react'
import Card from 'react-bootstrap/Card'
import LoveIcon from './icons/LoveIconComponent'
import ThumbsUpIcon from './icons/ThumbsUpIcon'

const styleContent = {
    height: "700px",
    width: "55%",
    marginLeft: "20px",
    marginTop: "10px",
    border: "2px solid black",

}

class SocialComponent extends React.Component {

    render() {
        return (
            <Card style={styleContent}>
                <Card.Body>
                    <Card.Title>Social Content</Card.Title>
                    <Card.Subtitle className="mb-2 text-muted">
                        All Shared Contents to be displayed
                        </Card.Subtitle>
                    <Card.Text>
                        Photos Videos Blogs To Be Displayed HERE.
                    </Card.Text>
                    {/* <Card.Link href="#">Card Link</Card.Link>
                    <Card.Link href="#">Another Link</Card.Link> */}
                    <div className="icons-display" style={{ display: "flex" }}>
                        <LoveIcon color={"red"} />
                        <ThumbsUpIcon style={{marginLeft:"5px"}}/>
                    </div>
                </Card.Body>
            </Card>
        )
    }
}

export default SocialComponent