import{_ as l}from"./DefaultLayout-cfe7cdd5.js";import{m as p,o as u,c,a as e,w as r,u as o,F as m,Z as _,b as i}from"./app-6702773d.js";import{u as d,p as a,P}from"./PostList-dd0e04f9.js";const f=i("title",null,"Home",-1),x={__name:"Feed",props:{posts:{type:Array}},setup(n){const{posts:s}=n,t=d();return p(()=>{a.listenCreatingPost(),a.listenDeletingPost(),t.setPosts(s.data),t.setCurrentPage(s.meta.current_page),t.setLastPage(s.meta.last_page)}),(g,B)=>(u(),c(m,null,[e(o(_),null,{default:r(()=>[f]),_:1}),e(l,null,{default:r(()=>[e(P,{posts:o(t).posts.data,onLoadMorePosts:o(a).loadMorePosts},null,8,["posts","onLoadMorePosts"])]),_:1})],64))}};export{x as default};
