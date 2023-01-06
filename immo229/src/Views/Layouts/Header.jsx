import React from 'react'
import "../../assets/Css/Header.css"
import logo from "../../assets/images/SVG/logo.svg";
import Nav from './Inc/Nav'

function Header() {
  return (
    <header>
        <a href="/">
          <img src={logo} alt="Logo" className='logo' />
        </a>
        <Nav/>
    </header>
  )
}

export default Header