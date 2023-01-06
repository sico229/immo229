import {useState,createContext,useContext } from "react";

const stateContext=createContext({
    user:null,
    token:null,
    setUser:()=>{},
    setToken:()=>{},
    _setUser:()=>{}
})

export const ContextProvider=({children})=>{
    const [user, setUser]=useState(localStorage.getItem('user'));
    const [token,_setToken]=useState(localStorage.getItem('ACCESS_TOKEN'));

    const setToken=(token)=>{
        _setToken(token);
        console.log(token);
        if(token){
            localStorage.setItem('ACCESS_TOKEN',token);
            localStorage.setItem('user',user);
        }else{
            localStorage.removeItem('ACCESS_TOKEN');
            localStorage.removeItem('user');
        }
    }

    const _setUser=(user)=>{
        setUser(user);
        if(user){
            
            localStorage.setItem('user',user);
        }else{
          
            localStorage.removeItem('user');
        }
    }
    return(
        <stateContext.Provider value={{
            user,
            token,
            setUser,
            setToken,
            _setUser,
        }}>
            {children}

        </stateContext.Provider>
    )
}

export const useStateContext=()=>useContext(stateContext);