import React, { Component } from 'react';
import PropTypes from 'prop-types';
import UserConsumer from '../context';
import axios from 'axios';
import {Link} from 'react-router-dom';

class List extends Component {

  static defaultProps ={
    name:"Bilgi Yok",
    meslek:"Bilgi Yok",
    gorevi:"Bilgi Yok",
    maasi:"Bilgi Yok"
  }

  state = {
    isVisible:false
  }
  
  /*constructor(props){
    super(props);

    this.state = {
      test:"Test",
      isVisible:false
    }

    this.onClickEvent=this.onClickEvent.bind(this);

  }*/


  onClickEvent = (number,e) =>{
     console.log(e);

     this.setState({
       isVisible: !this.state.isVisible
     })
   }

   onDeleteUser = async (dispatch,e) =>{

     const {id} = this.props;
     // Delete Request 

     await axios.delete(`http://127.0.0.1:8000/reactuser/${id}`)

     dispatch({type:"DELETE_USER",payload:id});
     
     //Consumer  dispatch
     
   }


   componentWillUnmount(){
     console.log("component will unmount");
     
   }
   render() {
    //Desctructing
    const {id,name,meslek,gorevi,maasi} = this.props;
    const {isVisible} = this.state;
    console.log(this.props);


    return (
      <UserConsumer>
      {
        value => {
          const {dispatch} = value;
          return (
            <div className="col-md-8 mb-4" >
            <div className="card" style={isVisible ? {backgroundColor:"#62848d",color:"black"} : null}>
            <div className="card-header d-flex justify-content-between">
            <h4 className ="d-inline" onClick={this.onClickEvent.bind(this,34)}>{name}</h4>
            <i onClick = {this.onDeleteUser.bind(this,dispatch)} className="far fa-trash-alt" style={{cursor:"pointer"}}></i>
            </div>
            {
              isVisible? <div className="card-body">
              <p className="card-text">Meslek:{meslek}</p>
              <p className="card-text">Gorevi:{gorevi}</p>
              <p className="card-text">Maası:{maasi}</p>
              <Link to = {`/edit/${id}`} className="btn btn-dark btn-block">Update User</Link>
              
              <p >{this.state.test}</p>
              </div>
              :null
            }
            </div>
            </div>
            );
        }
      }
      </UserConsumer>
      )


  }
}

List.propTypes={
  name:PropTypes.string.isRequired,
  meslek:PropTypes.string.isRequired,
  gorevi:PropTypes.string.isRequired,
  maasi:PropTypes.string.isRequired
}

List.defaultProps={
  name:"Bilgi Yok",
  meslek:"Bilgi Yok",
  gorevi:"Bilgi Yok",
  maasi:"Bilgi Yok"
}
export default List;
