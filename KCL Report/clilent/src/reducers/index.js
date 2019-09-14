import { combineReducers } from "redux";
import authReducer from "./authReducer";
import historyReducer from "./historyReducer";
import errorReducer from "./errorReducer";


// Combining the reducers
export default combineReducers({
  auth: authReducer,
  history: historyReducer,
  errors: errorReducer
});
