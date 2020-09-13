import React from 'react'
// import Container from 'react-bootstrap/Container'
// import Navbar from 'react-bootstrap/Navbar'
import Card from 'react-bootstrap/Card'

const styleContent={
    height:"100%",
    width:"20%",
    border:"2px solid",
    marginLeft:"10px",
    marginTop :"10px",
    backgroundColor:"#ff9933"
}
class ShareContainerComponent extends React.Component {
    render() {
        return (
                <Card style={styleContent} >
                    <Card.Body>Here will be the list of shared Videos/Contents and other STUFFS.</Card.Body>
                </Card>
        )
    }
}

export default ShareContainerComponent