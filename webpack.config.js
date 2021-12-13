const path = require("path");
const webpack = require("webpack");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = (env) => {
    return {
        entry: "./scripts/inject.js",
        mode: "development",
        output: {
            filename: "bundle.js",
            path: path.resolve(__dirname, "dist"),
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: "[name].bundle.css",
                chunkFilename: "[id].css",
            }),
            new webpack.HotModuleReplacementPlugin(),
        ],
        module: {
            rules: [
                {
                    test: /\.css?$/,
                    include: path.resolve(__dirname, "css"),
                    exclude: /node_modules/,
                    use: [
                        {
                            loader: MiniCssExtractPlugin.loader,
                        },
                        {
                            loader: "css-loader",
                            options: {
                                importLoaders: 0,
                            },
                        },
                    ],
                },
            ],
        },
        resolve: {
            extensions: [".js", ".css"],
        }
    };
};
