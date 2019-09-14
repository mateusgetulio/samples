import axios from "axios";
import { server } from "../common";

import {
  GET_HISTORY,
  GET_HISTORY_BY_MONTH,
  GET_HISTORY_BY_YEAR,
  GET_HISTORY_YEARS,
  GET_HISTORY_MONTHS
} from "./types";


// Get history
export const getHistory = () => {
  const request = axios.get(server + "/api/history/");
  return {
    type: GET_HISTORY,
    payload: request
  };
};

// Get history by a specific month
export const getHistoryByMonth = month => {
  const request = axios.get(server + "/api/history/month/" + month);
  return {
    type: GET_HISTORY_BY_MONTH,
    payload: request
  };
};


// Get history by a specific year
export const getHistoryByYear = year => {
  const request = axios.get(server + "/api/history/year/" + year);
  return {
    type: GET_HISTORY_BY_YEAR,
    payload: request
  };
};


// Get history by a margin of months
export const getHistoryMonths = () => {
  const request = axios.get(server + "/api/history/months/");
  return {
    type: GET_HISTORY_MONTHS,
    payload: request
  };
};


// Get history by a margin of years
export const getHistoryYears = () => {
  const request = axios.get(server + "/api/history/years/");
  return {
    type: GET_HISTORY_YEARS,
    payload: request
  };
};
