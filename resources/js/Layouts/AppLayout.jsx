import React from 'react';
import LeftNav from '../Components/leftNAV';

export default function AppLayout({ children, user, title }) {
  return (
    <div className="min-h-screen flex flex-col">
      {/* TOP NAV */}
      <header className="bg-white shadow border-b fixed w-full top-0 z-10">
        <div className="flex mx-auto items-center justify-between px-4 py-2">
          
          {/* Cột 1: Logo */}
          <div className="w-1/3 ml-[50px] flex justify-start items-center">
            <a href="/home" className="flex items-center">
              <img
                src="/img/iconstella.svg"
                alt="Logo"
                style={{ opacity: 0.8, maxWidth: '43px', height: 'auto' }}
              />
            </a>
          </div>

          {/* Cột 2: Tiêu đề */}
          <div className="w-1/3 text-center">
            <h4 className="text-lg font-semibold text-yellow-600">{title}</h4>
          </div>

          {/* Cột 3: User Info */}
          <div className="w-1/3 mr-[50px] flex justify-end text-right">
            {user && (
              <div>
                <div>🧑‍💼 {user.fullName}</div>
                <div>🛡️ {user.userGroup}</div>
              </div>
            )}
          </div>

        </div>
      </header>

      <div className="flex flex-1 pt-16"> {/* padding top để tránh đè lên header */}
    

        {/* MAIN CONTENT */}
        <main className="flex-1 p-4 bg-white">
          {children}
        </main>
      </div>
    </div>
  );
}
