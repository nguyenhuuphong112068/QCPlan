import React from 'react';

export default function topNAV({ user }) {
    return (
        <nav className="main-header navbar navbar-expand navbar-white navbar-light fixed-top" style={{ marginLeft: 250 }}>
            <div className="col-sm-2">
                <ul className="navbar-nav">
                    <li className="nav-item">
                        <a className="nav-link" href="#" role="button"><i className="fas fa-bars" /></a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="/logout">Log Out</a>
                    </li>
                </ul>
            </div>
            <div className="col-sm-8 d-flex justify-content-center align-items-center" style={{ color: '#CDC717' }}>
                <h4>DANH MỤC QUI TRÌNH KIỂM NGHIỆM</h4>
            </div>
            <div className="col-sm-2">
                <div className="info text-right">
                    <div>🧑‍💼 {user?.fullName}</div>
                    <div>🛡️ {user?.userGroup}</div>
                </div>
            </div>
        </nav>
    );
}
