import React from 'react';
import { createRoot} from 'react-dom/client';
import ReactDom from 'react-dom';
import {BrowserRouter, NavLink, Route, Switch } from 'react-router-dom';
import Dash from './dash';
import Another from './another';

class App extends React.Component {
    render (){
        return (
            <BrowserRouter>
                <div>
                    <ul>
                        <li><NavLink to="/">Dash</NavLink></li>
                        <li><NavLink to="/another">Another</NavLink></li>
                    </ul>
                 <Switch>
                        <Route path="/another" component={Another}/>
                        <Route path="/" component={Dash} />
                 </Switch>
                     
                </div>
            </BrowserRouter>
        )
    }
}

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<App/>);
