import React from 'react'
import { Navigate, Outlet } from 'react-router-dom';
import { useStateContext } from '../../assets/Contexts/ContextProvider'
import Header from './Header';

function AuthLayout() {
     const {user,token}=useStateContext();
    
    if(!token){
       return <Navigate to="/"/>
    }else{
      
    }
  return (
    <div>
      <Header/>      
      <Outlet/>        
    </div>
  )
}

export default AuthLayout