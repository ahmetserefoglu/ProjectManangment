require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route,IndexRoute, browserHistory,hashHistory  } from 'react-router';
import {BrowserRouter as Switch} from 'react-router-dom';
import { Provider } from "react-redux";
import Master from './components/Master';
import CreateItem from './components/CreateItem';
import DisplayItem from './components/DisplayItem';
import EditItem from './components/EditItem';
import Articles from "./components/Articles";
import Home from "./components/Home";
import Deneme from "./components/Deneme";
import User from './components/User.js';
import AddList from './forms/AddList.js';
import UpdateList from './forms/UpdateList.js';
import Lists from './components/Lists.js';
import NotFound from './pages/NotFound.js';
import Contribute from './pages/Contribute.js';
import {UserProvider} from './context';

render(
  <UserProvider>
  
      <Switch>

  <Router history={browserHistory}>
        <Route exact path="/react" component={Master } >
          <Route exact path="/home" component={Home} />
          <Route exact path="/list" component={Lists} />
          <Route exact path="/add" component={AddList} />
          <Route exact path="/user" component={User} />
          <Route exact path="/github" component={Contribute} />
          <Route exact path="/deneme" component={Deneme} />
          
          <Route exact path="/add-item" component={CreateItem} />
          <Route exact path="/display-item" component={DisplayItem} />
          <Route exact path = "/articles" component = { Articles }/>
          <Route component = {NotFound}/>
      </Route>            
  </Router>
      
      </Switch>
  </UserProvider>,
        document.getElementById('example'));