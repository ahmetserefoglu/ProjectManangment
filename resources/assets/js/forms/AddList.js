import React, { Component } from 'react';
import posed from 'react-pose';
import UserConsumer from '../context';
import axios from 'axios';
import {browserHistory} from 'react-router';

const Animation = posed.div({
  visible:{
    opacity : 1,
    applyAtStart:{
      display:"block"
    }
  },
  hidden:{
    opacity : 0,
    applyAtEnd:{
      display:"none"
    }
  }
});

//var uniqid = require('uniqid');

class AddList extends Component {

  state={
    visible:false,
    name : "",
    meslek : "",
    gorevi : "",
    maasi : "",
    error : false
  }


  changeVisibility = (e) => {
    this.setState({
      visible: !this.state.visible
    })

  }

  validateForm = () => {
    const {name,meslek,gorevi,maasi} = this.state;

    if(name === "" || meslek === "" || gorevi === "" || maasi === ""){
      return false;
    }

    return true;
  }
  changeInput = (e) => {
    this.setState({
      //name = "name"
      [e.target.name] : e.target.value
    })

  }

  /*
  changeName = (e) => {
    this.setState({
      name : e.target.value
    })
  
  }

  changeMeslek = (e) => {
    this.setState({
      meslek : e.target.value
    })
  
  }

  changeGorevi = (e) => {
    this.setState({
      gorevi : e.target.value
    })
  
  }

  changeMaasi = (e) => {
    this.setState({
      maasi : e.target.value
    })
  
  }*/

  addUser = async (dispatch,e) => {
    e.preventDefault();
    //console.log("Test");

    const {name,meslek,gorevi,maasi} = this.state;

    const newUser = {
      //artık gerek yok id : uniqid(),
      name : name,
      meslek : meslek,
      gorevi : gorevi,
      maasi : maasi
    }

    if(!this.validateForm()){
      this.setState({
        error: true
      })

      return;
    }
    const response = await axios.post("http://127.0.0.1:8000/reactuser",newUser);

    dispatch({type: "ADD_USER",payload:response.data});

    //Redirect
    browserHistory.push('/list');
    console.log(newUser);
  }

  render() {
    const {visible,name,meslek,gorevi,maasi,error} = this.state;
    return <UserConsumer>
    {
      value =>{
        const {dispatch} = value;

        return (
          <div className = "col-md-8 mb-4">
          <button onClick={this.changeVisibility} className="btn btn-dark btn-block mb-2">{visible? "Hide Form" : "Show Form"}</button>
          <Animation pose = {visible ? "visible" : "hidden"}>
          <div className="card">
          <div className="card-header">
          <h4>Add User</h4>

          <div className="card-body">
          {
            error ? 
            <div className="alert alert-danger">
              Lütfen Bilgilerinizi Kontrol Edin
            </div>
            :null
          }
          <form onSubmit= {this.addUser.bind(this,dispatch)}>
          <div className="form-group">
          <label htmlFor="name">Name</label>
          <input type="text" name = "name" id="name" placeholder="Adınız" className="form-control" value = {name}
          onChange = {this.changeInput}/>
          </div>
          <div className="form-group">
          <label htmlFor="meslek">Job</label>
          <input type="text" name = "meslek" id="meslek" placeholder="Enter Job" className="form-control" value = {meslek} 
          onChange = {this.changeInput}/>
          </div>
          <div className="form-group">
          <label htmlFor="gorevi">Department</label>
          <input type="text" name = "gorevi" id="gorevi" placeholder="Enter Department" className="form-control" value = {gorevi} 
          onChange = {this.changeInput}/>
          </div>
          <div className="form-group">
          <label htmlFor="maasi">Salary</label>
          <input type="text" name = "maasi" id="maasi" placeholder="Ente Salary" className="form-control" value = {maasi} 
          onChange = {this.changeInput}/>
          </div>
          <button className="btn btn-danger btn-block" type="submit">Add User</button>
          </form>
          </div>
          </div>
          </div>
          </Animation>
          </div>
          )

      }
    }
    </UserConsumer>
    
    
  }
}



export default AddList;
