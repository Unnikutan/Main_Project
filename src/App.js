import { BrowserRouter as Router, Routes, Route} from 'react-router-dom'
import './App.css';
// import LoginAction from './components/LoginAction';
import 'bootstrap/dist/css/bootstrap.min.css';
import './custom.scss';
import Home from './components/Home/Home';
import Login from './components/Login/Login';
import Register from './components/Login/Register';

function App() {
  return (
    <div>
      <Router>
        <Routes>
          <Route path='/' exact element={<Home />} />
          <Route path='/login' exact element={<Login />} />
          <Route path='/register' exact element={<Register />} />
        </Routes>
      </Router>
    </div>
  );
}

export default App;
