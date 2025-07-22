import React from 'react';
import { Link } from 'react-router-dom';

export default function leftNAV() {
    return (
        <aside className="main-sidebar sidebar-light-primary elevation-4" style={{ height: '100vh', width: '250px', position: 'fixed' }}>
            <div className="brand-link d-flex justify-content-center align-items-center">
                <img src="/img/iconstella.svg" alt="Logo" style={{ opacity: 0.8, maxWidth: 43 }} />
            </div>

            <div className="sidebar mt-3">
                <nav>
                    <ul className="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li className="nav-item has-treeview">
                            <a href="#" className="nav-link">
                                <i className="nav-icon fas fa-tachometer-alt" />
                                <p>Dữ Liệu Gốc<i className="right fas fa-angle-left" /></p>
                            </a>
                            <ul className="nav nav-treeview pl-3">
                                <li className="nav-item"><Link to="/product-name" className="nav-link"><p>Tên Sản Phẩm</p></Link></li>
                                <li className="nav-item"><Link to="/testing" className="nav-link"><p>Chỉ Tiêu Kiểm</p></Link></li>
                            </ul>
                        </li>

                        <li className="nav-item has-treeview">
                            <a href="#" className="nav-link">
                                <i className="nav-icon fas fa-tachometer-alt" />
                                <p>Danh Mục<i className="right fas fa-angle-left" /></p>
                            </a>
                            <ul className="nav nav-treeview pl-3">
                                <li className="nav-item"><Link to="/category/SOP" className="nav-link"><p>Qui Trình Kiểm Nghiệm</p></Link></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
    );
}
