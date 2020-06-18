import React, {Component} from 'react';
import { Router, Route, Link } from 'react-router';

class Master extends Component {
  render(){
    return (
      <div className="container">
        <nav className="navbar-nav navbar-expand-lg navbar-dark bg-dark mb-3">
          <div className="container-fluid">
            <div className="navbar-header">
              <a className="navbar-brand" href="/react">AppDividend</a>
            </div>
            <ul className="navbar-nav mb-auto">
              <li><Link to="/home" className="nav-link">Home</Link></li>
              <li><Link to="/list" className="nav-link">List User</Link></li>
              <li><Link to="/add" className="nav-link">Add User</Link></li>
              <li><Link to="/github" className="nav-link">Github</Link></li>
              <li><Link to="/deneme" className="nav-link">Deneme</Link></li>
              <li><Link to="/display-item" className="nav-link">Display Item</Link></li>
              <li><Link to="/add-item" className="nav-link">Add Item</Link></li>
              <li><Link to="/articles" className="nav-link">Articles</Link></li>

            </ul>
          </div>
      </nav>
          <div>
              {this.props.children}
          </div>
      </div>
    )
  }
}
export default Master;