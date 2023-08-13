import{T as b,o as n,c as a,a as c,w as f,u as t,F as i,Z as g,b as s,d as x,e as l,v as d,n as u,i as p,t as m,j as k,f as v}from"./app-15041f97.js";import{_ as y}from"./DefaultLayout-c1194746.js";const h=s("title",null,`
            Register
        `,-1),V={class:"card card-bordered max-w-xl mx-auto p-4"},q=["onSubmit"],N=s("label",{for:"name"},"Name",-1),U={class:"text-error mt-2"},$={class:"mt-4"},I=s("label",{for:"nickname"},"Nickname",-1),B={class:"text-error mt-2"},F={class:"mt-4"},R=s("label",{for:"email"},"Email",-1),S={class:"text-error mt-2"},T={class:"mt-4"},j=s("label",{for:"password"},"Password",-1),C={class:"text-error mt-2"},D={class:"mt-4"},E=s("label",{for:"password_confirmation"},"Password confirmation",-1),M={class:"text-error mt-2"},P={class:"flex items-center justify-end mt-4"},z=["disabled"],G={__name:"Register",setup(A){const e=b({name:"",email:"",password:"",nickname:"",password_confirmation:""}),_=()=>{e.post(route("register"),{onFinish:()=>e.reset("password","password_confirmation")})};return(w,o)=>(n(),a(i,null,[c(t(g),null,{default:f(()=>[h]),_:1}),c(y,null,{default:f(()=>[s("div",V,[s("form",{onSubmit:x(_,["prevent"])},[s("div",null,[N,l(s("input",{id:"name","onUpdate:modelValue":o[0]||(o[0]=r=>t(e).name=r),type:"text",class:u(["input input-bordered mt-1 block w-full",{"input-error":t(e).errors.name}]),required:"",autofocus:"",autocomplete:"name",onInput:o[1]||(o[1]=r=>t(e).errors.name=null)},null,34),[[d,t(e).name]]),(n(!0),a(i,null,p(t(e).errors.name,r=>(n(),a("span",U,m(r),1))),256))]),s("div",$,[I,l(s("input",{id:"name","onUpdate:modelValue":o[2]||(o[2]=r=>t(e).nickname=r),type:"text",class:u(["input input-bordered mt-1 block w-full",{"input-error":t(e).errors.nickname}]),required:"",autofocus:"",autocomplete:"name",onInput:o[3]||(o[3]=r=>t(e).errors.nickname=null)},null,34),[[d,t(e).nickname]]),(n(!0),a(i,null,p(t(e).errors.nickname,r=>(n(),a("span",B,m(r),1))),256))]),s("div",F,[R,l(s("input",{id:"email","onUpdate:modelValue":o[4]||(o[4]=r=>t(e).email=r),type:"email",class:u(["input input-bordered mt-1 block w-full",{"input-error":t(e).errors.email}]),required:"",autocomplete:"username",onInput:o[5]||(o[5]=r=>t(e).errors.email=null)},null,34),[[d,t(e).email]]),(n(!0),a(i,null,p(t(e).errors.email,r=>(n(),a("span",S,m(r),1))),256))]),s("div",T,[j,l(s("input",{id:"password","onUpdate:modelValue":o[6]||(o[6]=r=>t(e).password=r),type:"password",class:u(["input input-bordered mt-1 block w-full",{"input-error":t(e).errors.password}]),required:"",autocomplete:"new-password",onInput:o[7]||(o[7]=r=>t(e).errors.password=null)},null,34),[[d,t(e).password]]),(n(!0),a(i,null,p(t(e).errors.password,r=>(n(),a("span",C,m(r),1))),256))]),s("div",D,[E,l(s("input",{id:"password_confirmation","onUpdate:modelValue":o[8]||(o[8]=r=>t(e).password_confirmation=r),type:"password",class:"input input-bordered mt-1 block w-full",required:"",autocomplete:"new-password"},null,512),[[d,t(e).password_confirmation]]),s("p",M,m(t(e).errors.password_confirmation),1)]),s("div",P,[c(t(k),{href:w.route("login"),class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:f(()=>[v(" Already registered? ")]),_:1},8,["href"]),s("button",{class:u(["btn btn-primary ml-4",{"opacity-25":t(e).processing}]),disabled:t(e).processing}," Register ",10,z)])],40,q)])]),_:1})],64))}};export{G as default};
