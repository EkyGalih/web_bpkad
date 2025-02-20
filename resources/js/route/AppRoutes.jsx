import { Routes } from "react-router-dom"

const AppRoutes = () => {
    return (
        <Routes>
            <Route path="/" element={<Home />}>
                <Route index element={<Home />} />
            </Route>
        </Routes>
    )
}