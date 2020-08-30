import React from 'react';

class ProfileComponent extends React.Component{

    componentWillUnmount(){
        return ""
    }
    render(){
        return(
            <div style={{color:"red"}}>
              <h1>  {"Welcome " + this.props.item.firstName}</h1>
            </div>
        )
    }
}

export default ProfileComponent