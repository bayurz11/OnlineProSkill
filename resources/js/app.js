import './bootstrap';
// resources/js/app.js
import React from 'react';
import ReactDOM from 'react-dom';
import AnimatedComponent from './components/AnimatedComponent';

const App = () => {
    return (
        <div>
            <h1 className="text-center mt-5">Proyek Laravel dengan React</h1>
            <AnimatedComponent />
        </div>
    );
};

ReactDOM.render(<App />, document.getElementById('app'));
