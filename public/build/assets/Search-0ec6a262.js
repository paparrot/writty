import{r as d,m as p,o as _,c as i,a,w as r,u as h,F as m,Z as f,b as e,e as v,v as w,d as b,q as x,s as S,O as g}from"./app-f82d25fa.js";import{_ as y}from"./DefaultLayout-9bd91ec8.js";import{_ as B,P as I}from"./PostList-ab9554d8.js";const o=s=>(x("data-v-bc628084"),s=s(),S(),s),M=o(()=>e("title",null,"Search",-1)),P=["onSubmit"],V={class:"border border-neutral rounded w-full flex"},q=o(()=>e("svg",{class:"h-12 w-24",id:"Layer_1",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 500 500"},[e("rect",{class:"cls-2",width:"500",height:"500"}),e("path",{class:"cls-1",d:"M245.99,113.21c-74.7,0-135.6,60.23-136.68,134.69-1.1,75.61,60.25,138.27,135.87,138.71,23.36,.14,45.85-5.57,65.82-16.43,1.95-1.06,2.25-3.74,.59-5.21l-12.79-11.34c-2.6-2.3-6.3-2.96-9.5-1.6-13.94,5.93-29.09,8.96-44.71,8.77-61.11-.75-110.48-51.59-109.5-112.69,.96-60.33,50.34-109.11,110.89-109.11h110.91v197.12l-62.92-55.91c-2.04-1.81-5.16-1.46-6.8,.72-10.1,13.37-26.55,21.69-44.83,20.43-25.35-1.75-45.89-22.16-47.79-47.5-2.27-30.22,21.68-55.55,51.44-55.55,26.91,0,49.07,20.71,51.38,47.03,.21,2.34,1.26,4.53,3.02,6.08l16.39,14.53c1.86,1.65,4.81,.64,5.27-1.8,1.18-6.32,1.6-12.9,1.13-19.66-2.64-38.49-33.81-69.45-72.32-71.82-44.14-2.72-81.05,31.81-82.22,75.1-1.14,42.18,33.42,78.55,75.61,79.48,17.61,.39,33.94-5.15,47.13-14.74l82.22,72.88c3.52,3.12,9.09,.62,9.09-4.09V118.4c0-2.87-2.32-5.19-5.19-5.19H245.99Z"})],-1)),L=o(()=>e("button",{class:"btn border-neutral btn-outline"},"Search",-1)),k={__name:"Search",props:{posts:{type:Array,default:()=>[]}},setup(s){const t=d("");p(()=>{const c=new URLSearchParams(window.location.search);t.value=c.get("q")});const n=()=>{g.get(route("posts.search",{q:t.value}))};return(c,l)=>(_(),i(m,null,[a(h(f),null,{default:r(()=>[M]),_:1}),a(y,null,{default:r(()=>[e("form",{onSubmit:b(n,["prevent"]),class:"flex gap-3 px-3 mb-4"},[e("div",V,[v(e("input",{type:"text",placeholder:"Type something...","onUpdate:modelValue":l[0]||(l[0]=u=>t.value=u),class:"input w-full"},null,512),[[w,t.value]]),q]),L],40,P),a(I,{posts:s.posts.data},null,8,["posts"])]),_:1})],64))}},T=B(k,[["__scopeId","data-v-bc628084"]]);export{T as default};